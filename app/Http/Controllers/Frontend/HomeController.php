<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Sanpham;
use App\Models\Danhmuc;
use App\Models\Hinhsanpham;
use App\Models\Chitiet_donhang;
use App\Models\Donhang;
use App\Models\Thuonghieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use App\Models\Rating;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $donghonams = Sanpham::where('danhmuc_id', 1)->get();
        $donghonus = Sanpham::where('danhmuc_id', 2)->get();
        $donghodois = Sanpham::where('danhmuc_id', 3)->get();
        $brands = Thuonghieu::all();
        $userlog = Auth::user();
        return view("frontend.index", compact("donghonams", "donghonus", "donghodois", "brands", "userlog"));
    }

    public function contact()
    {
        $brands = Thuonghieu::all();
        $userlog = Auth::user();
        return view("frontend.contact", compact("brands", "userlog"));
    }
    public function productDetail($id, $slug)
    {
        $products = Sanpham::all();
        $product = Sanpham::findOrFail($id);
        $imgs = Sanpham::with('sp_hinhsanpham')->find($id);
        $brands = Thuonghieu::all();
        $userlog = Auth::user();

        // Lấy các sản phẩm tương tự
        $otherProducts = SanPham::where('danhmuc_id', $product->danhmuc_id)
            ->where('id', '!=', $id)
            ->take(5) 
            ->get();
        
        $ratingCount = Rating::whereHas('rating_ct', function($query) use ($product) {
            $query->where('trangthai', 1)
            ->where('sanpham_id', $product->id);
        })->count();

        $rating = Rating::whereHas('rating_ct', function($query) use ($product) {
            $query->where('sanpham_id', $product->id) // Lọc theo ID sản phẩm
                  ->where('trangthai', 1); 
        })->avg('rating');
        $rating = round($rating);

        // Lấy các bình luận
        Carbon::setLocale('vi');
        $comments = Rating::whereHas('rating_ct', function($query) use ($product) {
            $query->where('sanpham_id', $product->id) 
                  ->where('trangthai', 1); 
        })->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($comment) {
                $comment->formatted_date = Carbon::parse($comment->created_at)->translatedFormat('d F, Y \| H:i');
                return $comment;
            });

        $initialComments = $comments->take(3);
        $show_all_comments = $comments->count() > 3;

        return view("frontend.product-detail", compact("product", "brands", "products", "otherProducts", "userlog", "imgs", "rating", "ratingCount", "initialComments", "comments", "show_all_comments"));
    }

    public function rateProduct(Request $request, $id)
    {
        $messages = [
            'rating.required' => 'Đánh giá sao là bắt buộc!',
            'comment.max' => 'Bình luận tối đa 100 ký tự',
        ];
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ], $messages);

        $user = Auth::user();

        // Lấy tất cả chi tiết đơn hàng của khách hàng với sản phẩm này
        $chitietDonhangs = Chitiet_donhang::whereHas('ct_donhang', function ($query) use ($user) {
            $query->where('user_id', $user->id)
                ->where('trangthai', 'Đã giao');;
        })->where('sanpham_id', $id)->get();

        if ($chitietDonhangs->isEmpty()) {
            return redirect()->back()->with('error', 'Bạn chỉ có thể đánh giá các sản phẩm bạn đã mua hoặc đơn hàng đã được giao.');
        }

        foreach ($chitietDonhangs as $chitietDonhang) {
            // Kiểm tra xem người dùng đã đánh giá chi tiết đơn hàng này chưa
            $existingRating = Rating::where('chitietdh_id', $chitietDonhang->id)
                ->where('user_id', $user->id)
                ->first();

            if (!$existingRating) {
                // Nếu chưa có đánh giá, tạo mới đánh giá
                Rating::create([
                    'rating' => round($request->rating),
                    'comment' => $request->comment,
                    'user_id' => $user->id,
                    'trangthai' => 0,
                    'chitietdh_id' => $chitietDonhang->id,
                ]);

                return redirect()->back()->with('success', 'Đánh giá của bạn đã được lưu, chờ duyệt.');
            }
        }

        // Nếu tất cả chi tiết đơn hàng đã được đánh giá
        return redirect()->back()->with('error', 'Bạn đã đánh giá sản phẩm này trong tất cả các lần mua hàng.');
    }

    public function login()
    {
        return view("frontend.login");
    }
    public function checkLogin(Request $request)
    {
        $messages = [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại. Vui lòng sử dụng email khác.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.regex' => 'Mật khẩu phải có ít nhất 6 ký tự, không có khoảng trống.',
        ];
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => [
                'required',
                'regex:/^\S{6,}$/u'
            ],
        ], $messages);
        
        $user = User::where('email', $request->email)->first();

        if (is_null($user->email_verified_at)) {
            
            $lastSent = session('email_verification_sent_at');
            $currentTimestamp = Carbon::now();

            if ($lastSent && $lastSent->diffInMinutes($currentTimestamp) < 10) {
                return redirect()->back()->with('error', 'Email xác nhận đã được gửi trước đó, vui lòng chờ ít nhất 10 phút để gửi lại.');
            }

            // Gửi email xác nhận
            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(10),
                ['id' => $user->id]
            );

            Mail::send('frontend.verify-email-register', ['user' => $user, 'verificationUrl' => $verificationUrl], function ($email) use ($user) {
                $email->to($user->email, $user->name);
                $email->subject('DongHoShop - Xác nhận đăng ký tài khoản');
            });

            // Cập nhật thời gian gửi email cuối cùng trong session
            session(['email_verification_sent_at' => $currentTimestamp]);

            return redirect()->back()->with('error', 'Email của bạn chưa được xác nhận. Một email xác nhận mới đã được gửi, vui lòng kiểm tra hộp thư.');
        }

        // Kiểm tra thông tin đăng nhập
        $credentials = $request->only('email', 'password');
        $credentials['loai'] = 0;
        $credentials['trangthai'] = 1;

        if (Auth::attempt($credentials)) {
            $cart = session()->get('cart', []);
            if ($cart) {
                return redirect()->route('checkout.index');
            }
            return redirect()->route('frontend.index');
        }
        
        
        return redirect()->back()->with('error', 'Email hoặc mật khẩu không chính xác hoặc đã bị ngưng hoạt động !');
    }
    public function register()
    {
        return view("frontend.register");
    }
    public function storeRegister(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if ($user && is_null($user->email_verified_at)) {
            
            return redirect()->back()->with('error', 'Email đã được đăng ký nhưng chưa xác nhận. Vui lòng kiểm tra email để xác nhận trước khi tiếp tục.');
        }
        $messages = [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại. Vui lòng sử dụng email khác.',
            'name.required' => 'Tên là bắt buộc.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.regex' => 'Mật khẩu phải có ít nhất 6 ký tự, không có khoảng trống.',
        ];
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'name' => 'required',
            'password' => [
                'required',
                'regex:/^\S{6,}$/u'
            ],
        ], $messages);
        
        $request->merge(['password' => Hash::make($request->password)]);

        try {
            
            $userData = $request->except('_token', 'confirm_password');
            $user = User::create($userData);

            $lastSent = session('email_verification_sent_at');
            $currentTimestamp = Carbon::now();

            if ($lastSent && $lastSent->diffInMinutes($currentTimestamp) < 10) {
                return redirect()->back()->with('error', 'Email xác nhận đã được gửi trước đó, vui lòng chờ ít nhất 10 phút để gửi lại.');
            }

            $verificationUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(10),
                ['id' => $user->id]
            );

            Mail::send('frontend.verify-email-register', ['user' => $user, 'verificationUrl' => $verificationUrl], function ($email) use ($user) {
                $email->to($user->email, $user->name);
                $email->subject('DongHoShop - Xác nhận đăng ký tài khoản');
            });

        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'Đã xảy ra lỗi, vui lòng thử lại.');
        }
        return redirect()->route('userLogin.index')->with('success', 'Tạo tài khoản thành công ! Hãy bắt đầu đăng nhập');
    }
    public function verify(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('userLogin.index')->with('error', 'Người dùng không tồn tại.');
        }

        if (! $request->hasValidSignature()) {
            return redirect()->route('userLogin.index')->with('error', 'Liên kết xác nhận không hợp lệ.');
        }

        if (!is_null($user->email_verified_at)) {
            return redirect()->route('userLogin.index')->with('info', 'Email đã được xác nhận trước đó.');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('userLogin.index')->with('success', 'Email của bạn đã được xác nhận thành công.');
    }
    public function userlogout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('userLogin.index');
    }
    public function forgotPasswordIndex()
    {
        return view('frontend.forgot-password');
    }


    // Xử lý gửi email quên mật khẩu
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users'
        ], [
            'email.email' => 'Vui lòng nhập email hợp lệ !',
            'email.required' => 'Vui lòng không để trống !',
            'email.exists' => 'Email này không tồn tại !',
        ]);

        $user = User::where('email', $request->email)->first();
    
        $passwordResetSentAt = $request->session()->get('password_reset_sent_at');
        $now = Carbon::now();

        // Nếu thời gian gửi email trước đó và mã vẫn còn hiệu lực
        if ($passwordResetSentAt && $now->lessThan(Carbon::parse($passwordResetSentAt)->addMinutes(10))) {
            return redirect()->back()->with('error', 'Mã xác nhận có hiệu lực 10 phút. Vui lòng thử lại sau ít nhất 10 phút.');
        }
        
        $token = Str::random(60);
        $user->update(['remember_token' => $token]);

        $expiryTime = $now->addMinutes(10);

        // Lưu thời gian gửi email vào session
        $request->session()->put('password_reset_sent_at', $now);
        // Gửi email với thời gian hiệu lực
        Mail::send('frontend.check-email-forgot-password', [
            'user' => $user,
            'expiryTime' => $expiryTime->format('H:i:s d-m-Y')
        ], function ($email) use ($user) {
            $email->to($user->email, $user->name);
            $email->subject('DongHoShop - Lấy lại mật khẩu');
        });

        return redirect()->back()->with('success', 'Vui lòng check email của bạn để thay đổi mật khẩu !.');
    }

    // Hiển thị form đặt lại mật khẩu
    public function resetPasswordIndex($token)
    {
        return view('frontend.reset-password', ['token' => $token]);
    }

    // Đặt lại mật khẩu
    public function resetPassword(Request $request)
    {
        $message = [
            'email.email' => 'Vui lòng nhập email hợp lệ !',
            'email.required' => 'Vui lòng nhập email !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'password.confirmed' => 'Mật khẩu nhập lại không chính xác !',
            'password.regex' => 'Mật khẩu có độ dài tối thiểu 6 ký tự và không có khoảng trống!',
        ];
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|regex:/^\S{6,}$/u',
        ], $message);

        // Tìm token trong cơ sở dữ liệu
        $reset = User::where('remember_token', $request->input('token'))
            ->where('email', $request->input('email'))
            ->first();

        if (!$reset) {
            return back()->with(['error' => 'Token email đặt lại mật khẩu không hợp lệ hoặc đã hết hạn.']);
        }
        
        $passwordResetSentAt = Carbon::parse($request->session()->get('password_reset_sent_at'));
        $expiryTime = $passwordResetSentAt->addMinutes(10);
    
        if (Carbon::now()->greaterThan($expiryTime)) {
            return back()->with(['error' => 'Mã reset đã hết hiệu lực.']);
        }
        // Cập nhật mật khẩu
        $user = User::where('email', $request->input('email'))->first();
        if ($user) {
            $user->password = Hash::make($request->input('password'));
            $user->remember_token = null;
            $user->save();
             
            // Xóa thời gian gửi email khỏi session sau khi sử dụng
            $request->session()->forget('password_reset_sent_at');
        }

        return redirect()->route('userLogin.index')->with('success', 'Mật khẩu đã được đặt lại thành công.');
    }
    public function search(Request $request)
    {
        $brands = Thuonghieu::all();
        $caterogys = Danhmuc::all();
        $userlog = Auth::user();
        $query = $request->input('query');
        $stopWords = ['dây', 'màu', 'kính','mặt','máy','năng lượng','vỏ'];
        
        // Loại bỏ các từ không cần thiết khỏi cụm từ tìm kiếm
        $filteredQuery = collect(explode(' ', $query))
            ->filter(function ($word) use ($stopWords) {
                return !in_array($word, $stopWords);
            })
            ->implode(' ');

        $keywords = explode(' ', $filteredQuery);

        $productsQuery = Sanpham::query();

        if ($filteredQuery) {
            $productsQuery->where(function ($queryBuilder) use ($keywords) {
                foreach ($keywords as $keyword) {
                    $queryBuilder->where(function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "%$keyword%");
                        $q->orWhere(function ($subQuery) use ($keyword) {
                            $subQuery->where('loai_day', 'LIKE', "%$keyword%")
                                ->orWhere('loai_mat', 'LIKE', "%$keyword%")
                                ->orWhere('loai_kinh', 'LIKE', "%$keyword%")
                                ->orWhere('mau_day', 'LIKE', "%$keyword%")
                                ->orWhere('mau_vo', 'LIKE', "%$keyword%")
                                ->orWhere('mau_mat', 'LIKE', "%$keyword%")
                                ->orWhere('nangluong', 'LIKE', "%$keyword%")
                                ->orWhereHas('sp_thuonghieu', function ($q) use ($keyword) {
                                    $q->where('tenTH', 'LIKE', "%$keyword%");
                                })
                                ->orWhereHas('sp_danhmuc', function ($q) use ($keyword) {
                                    $q->where('tenDM', 'LIKE', "%$keyword%");
                                });
                        });
                    });
                }
            });
        }

        $filters = $request->except(['query', '_token', 'page', 'sort']);
        // Áp dụng các bộ lọc
        if (!empty($filters)) {
            foreach ($filters as $key => $value) {
                switch ($key) {
                    case 'brand':
                        $productsQuery->whereHas('sp_thuonghieu', function ($q) use ($value) {
                            $q->where('tenTH', 'LIKE', "%$value%");
                        });
                        break;
                    case 'caterogy':
                        $productsQuery->whereHas('sp_danhmuc', function ($q) use ($value) {
                            $q->where('tenDM', 'LIKE', "%$value%");
                        });
                        break;
                    case 'loai_day':
                        $productsQuery->where('loai_day', 'LIKE', "%$value%");
                        break;
                    case 'loai_mat':
                        $productsQuery->where('loai_mat', 'LIKE', "%$value%");
                        break;
                    case 'loai_kinh':
                        $productsQuery->where('loai_kinh', 'LIKE', "%$value%");
                        break;
                    case 'mau_day':
                        $productsQuery->where('mau_day', 'LIKE', "%$value%");
                        break;
                    case 'mau_vo':
                        $productsQuery->where('mau_vo', 'LIKE', "%$value%");
                        break;
                    case 'mau_mat':
                        $productsQuery->where('mau_mat', 'LIKE', "%$value%");
                        break;
                    case 'size':
                        if ($value === '20-30mm') {
                            $productsQuery->whereBetween('size', [20, 30]);
                        } elseif ($value === '30-40mm') {
                            $productsQuery->whereBetween('size', [30, 40]);
                        } elseif ($value === '40-50mm') {
                            $productsQuery->whereBetween('size', [40, 50]);
                        }
                        break;
                    case 'gia':
                        if ($value === '-1tr') {
                            $productsQuery->whereBetween('gia', [0, 1000000]);
                        } elseif ($value === '1-5tr') {
                            $productsQuery->whereBetween('gia', [1000000, 5000000]);
                        } elseif ($value === '5-10tr') {
                            $productsQuery->whereBetween('gia', [5000000, 10000000]);
                        } elseif ($value === '10tr+') {
                            $productsQuery->where('gia', '>', 10000000);
                        }
                        break;
                }
            }
        }
        // Lấy giá trị của sắp xếp từ request
        $sort = $request->input('sort');
        // Áp dụng sắp xếp
        switch ($sort) {
            case 'name-asc':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $productsQuery->orderBy('name', 'desc');
                break;
            case 'price-asc':
                $productsQuery->orderBy('gia', 'asc');
                break;
            case 'price-desc':
                $productsQuery->orderBy('gia', 'desc');
                break;
            default:
                // Sắp xếp mặc định
                break;
        }

        $products = $productsQuery->paginate(5);
        $products->appends($request->except('page'));

        return view('frontend.search-result', compact('products', 'brands', 'userlog', 'caterogys'));
    }
}
