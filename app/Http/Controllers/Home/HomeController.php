<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Mail\ConfirmationMail;
use App\Mail\PointsMail;
use App\Models\Email;
use App\Models\User;
use App\Models\UserAddress;
use App\Models\UserWishlist;
use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\SignupEmail;
use App\Models\WebsiteBlog;
use Auth;
use Exception;
use Mail;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    

    /**
    * Website main landing page.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function index(Request $request){

        $products = Product::limit(10)->get();
        return view('index', compact('products'));

    }

    /**
    * Login UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function login(){

        return view('userpage.login');

    }

    /**
    * Registration UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function register(){

        return view('userpage.register');

    }

    /**
    * Shop UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function shop(Request $request){
        $search = null;
        if($request->get('search') != ''){
            $search = $request->get('search');
            $data = Product::where('product_name', 'LIKE', '%'.$request->get('search').'%')->paginate(12); 
            return view('userpage.shop', compact('data', 'search'));
        }else{
            $data = Product::paginate(12);    
            return view('userpage.shop', compact('data', 'search'));
        }

    }

    /**
    * Shop List.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function shopList(Request $request){
        
        if($request->get('search') != ''){
            $data = Product::where('product_name', 'LIKE', '%'.$request->get('search').'%')->paginate(12);   
        }else{
            $data = Product::paginate(12);    
        }
        
        return view('incs.shop-list', compact('data'));

    }

    /**
    * Blog UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function blog(){

        $blogs = WebsiteBlog::get();

        return view('userpage.blog', compact('blogs'));

    }
    
    /**
    * Contact UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function contactus(){

        return view('userpage.contact');

    }


    /**
    * About Us UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function about(){

        return view('userpage.about');

    }


    /**
    * Cart UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function cart(){

        return view('userpage.cart');

    }
    
    /**
    * Wishlist UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function wishlist(){

        $productWishlist = UserWishlist::where('user_id', auth()->user()->id);

        return view('userpage.wishlist', compact('productWishlist'));

    }


    /**
    * Wishlist UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function myProfile(){
       
        return view('userpage.profile');

    }


    /**
    * Orders UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function myOrders(){
        
        $productOrder = ProductOrder::where('user_id', auth()->user()->id);

        return view('userpage.my-order', compact('productOrder'));

    }


    
    /**
    * Checkout UI.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    * @return void
    */
    public static function checkout(){
        
        if(auth::check()){
            return view('userpage.checkout');
        }else{
            return view('userpage.guest-checkout');
        }
        

    }



    /**
    * Register a user account
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public static function registerUser(Request $request){

        $selectIfEmailAlreadyExist = User::where('email', $request->email)->orWhere('email', $request->email)->count();

        if($selectIfEmailAlreadyExist != 0){
            return Array(
                'success' => false,
                'internalMessage' => 'The email or phone number was already used!',
                'userMessage' => 'The email or phone number was already used!',
            );
        }
        
        try{
            
            $generatedPassword = Str::random(6);
            
            $email_data = array(
                'password'=> $generatedPassword,
            );

                Mail::to($request->email)->send(new ConfirmationMail($email_data));
                
                    if(Mail::failures()) {
                        
                        return Array(
                            'success' => false,
                            'internalMessage' => 'Registration failed! Please check your network connection.',
                            'userMessage' => 'Registration failed! Please check your network connection.',
                        );    

                    }else{

                        $user = new User();
                        $user->first_name = $request->firstName;
                        $user->last_name = $request->lastName;
                        $user->middle_name = $request->middleName;
                        $user->email = $request->email;
                        $user->password = Hash::make($generatedPassword);
                        $user->referral_link = Str::random(32);
                        
                        if($user->save()){

                            if(isset($request->ref_link)){

                                $getRefferalinfo = User::where('referral_link','=', $request->ref_link);
                                
                                if($getRefferalinfo->count() != 0){
            
                                        $updateReferrerPoints = $getRefferalinfo->update([
                                            'tokens' => $getRefferalinfo->get()->first()->tokens + 100
                                        ]);
                                    
                                }
            
                            }

                        }else{
                            return Array(
                                'success' => false,
                                'internalMessage' => 'Registration failed!',
                                'userMessage' => 'Something went wrong!',
                            );    
                        }

                        return Array(
                            'success' => true,
                            'internalMessage' => 'User registered successfully!',
                            'userMessage' => 'You are registered succesfully!',
                        );

                    }
                

        }catch(\Exception $e) {
        
            return Array(
                'success' => false,
                'internalMessage' => $e->getMessage(),
                'userMessage' => 'Something went wrong in registration!',
            );
        
        }

    }

    /**
    * Authenticate user account
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function resetPassCode(Request $request){

        $generatedPassword = Str::random(6);
        $email_data = array(
            'password'=> $generatedPassword,
        );
        Mail::to($request->email)->send(new ConfirmationMail($email_data));
        
        if(Mail::failures()) {
                        
            return Array(
                'success' => false,
                'internalMessage' => 'Resend failed please try again in a few.',
                'userMessage' => 'Resend failed please try again in a few.',
            );    

        }else{
            $updateUserPassword = User::where('email', $request->email)->update([

                'password' => Hash::make($generatedPassword)

            ]);

            return Array(
                'success' => true,
                'internalMessage' => 'New Password has sent to your email kindly check again.',
                'userMessage' => 'New Password has sent to your email kindly check again.',
            );

        }

    }

    /**
    * Authenticate user account
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public static function authenticateUser(Request $request){

        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') ])) {
            return Array(
                'success' => true,
                'internalMessage' => 'User logged in successfully!',
                'userMessage' => 'User logged in successfully!'
            );
        } else {
            return Array(
                'success' => false,
                'internalMessage' => 'Please check your credentials!',
                'userMessage' => 'Please check your credentials!'
            );
        }

    }

    /**
    * Authenticate user account
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function singleBlog($id){

        $singleBlog = WebsiteBlog::find($id);

        return view('userpage.single-blog', compact('singleBlog'));

    }

    /**
    * Update user profile info
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function addProfilePicture(Request $request){

        $main_image = '';

        if($request->hasFile('txtFileProfilePicture')){
            $primaryFilenameWithExt = $request->file('txtFileProfilePicture')->getClientOriginalName();
            $primaryFileName = pathinfo($primaryFilenameWithExt, PATHINFO_FILENAME);
            $primaryExtension = $request->file('txtFileProfilePicture')->getClientOriginalExtension();
            $primaryFileNameToStore = $primaryFileName.'_'.time().'.'.$primaryExtension;
            $path = $request->file('txtFileProfilePicture')->storeAs('public/user_images', $primaryFileNameToStore);
            if(config('app.env') == 'local'){
                $main_image = '/storage/user_images/'.$primaryFileNameToStore;
            }else{
                $main_image = '/user_images/'.$primaryFileNameToStore;
            }
        }

        $user = User::find(auth()->user()->id);
        $user->profile_picture_url = $main_image;
        $user->save();

        return 'success';

    }

    
    /**
    * Update user profile info
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public static function updateUserInfo(Request $request){

        $user = User::find(auth()->user()->id);
        $user->first_name = $request->txtFirstName;
        $user->last_name = $request->txtLastName;
        $user->middle_name = $request->txtMiddleName;

        if($user->email != $request->txtEmail){
            $findIfEmailTaken = User::where('email', $request->txtEmail)->get()->count();
            if($findIfEmailTaken != 0){
                return Array(
                    'success' => false,
                    'internalMessage' => 'Email already taken! Please use another email',
                    'userMessage' => 'Email already taken! Please use another email',
                );
            }else{
                $user->email = $request->txtEmail;
                $user->save();
                return Array(
                    'success' => true,
                    'internalMessage' => 'Basic info updated successfully!',
                    'userMessage' => 'Basic info updated successfully!'
                );
            }

        }else{

            $user->save();
            return Array(
                'success' => true,
                'internalMessage' => 'Basic info updated successfully!',
                'userMessage' => 'Basic info updated successfully!'
            );

        }
        


    }

    /**
    * Update user password
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateUserPassword(Request $request){

        $hashedPassword = User::find(auth()->user()->id)->password;

        if (!Hash::check($request->txtCurrentPassword, $hashedPassword)) {
            
            return response()->json(['success'=>false, 'message' => 'You enter the wrong password please try again.']);
         
        }else{

            if($request->txtNewPassword == $request->txtRetypePassword){

                $updateUser = User::find(auth()->user()->id);
                $updateUser->password = Hash::make($request->txtNewPassword);
                
                if($updateUser->save()){
                    return response()->json(['success' => false, 'message' => 'Password updaed successfully!']); 
                }

            } else {

                return response()->json(['success' => false, 'message' => 'Login']); 
            
            }
         
        }
    }

    /**
    * Update user address
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function updateUserAddress(Request $request){

        $findUserAddress = UserAddress::whereIn('user_id', [auth()->user()->id]);

        if($findUserAddress->count() != 0){

            $updateAddressInfo = $findUserAddress->update([
                'address' => $request->address1,
                'address_complement' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->postcode,
                'country' => $request->country,
                'status' => 1,
            ]);

            if($updateAddressInfo){
                return response()->json(['success' => true, 'internalMessage' => 'Your address updated successfully.']); 
            }else{
                return response()->json(['success' => false, 'internalMessage' => 'Something went wrong.']);
            }

        }else{

            $insertUserAddress = UserAddress::insert([
                'user_id' => auth()->user()->id,
                'address' => $request->address1,
                'address_complement' => $request->address2,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->postcode,
                'country' => $request->country,
                'status' => 1,
            ]);

            if($insertUserAddress){
                return response()->json(['success' => true, 'internalMessage' => 'Your address updated successfully.']); 
            }else{
                return response()->json(['success' => false, 'internalMessage' => 'Something went wrong.']);
            }

        }


    }

    public function testPaymenGcash(){

        // Set your X-API-KEY with the API key from the Customer Area.
        $client = new \Adyen\Client();
        $client->setXApiKey("AQEohmfuXNWTK0Qc+iSAh3Y9j+WLWIJBBJVPOK2ie+xYWqBjKJXgIpygehDBXVsNvuR83LVYjEgiTGAH-VwKxFWXbXzEfoC7iWLUcmrgZYLx0kENTJqygvgHBbHM=-,U{xI$4.<2dc%6HY"); 
        $client->setEnvironment(\Adyen\Environment::TEST);    
        $service = new \Adyen\Service\Checkout($client);
        
        $params = array(
        "amount" => array(
            "currency" => "PHP",
            "value" => 1000
        ),
        "reference" => "YOUR_ORDER_NUMBER",
        "paymentMethod" => array(
            "type" => "gcash"
        ),
        "returnUrl" => "https://your-company.com/checkout?shopperOrder=12xy..",
        "merchantAccount" => "PureHappilifeECOM"
        );

        $result = $service->payments($params);

        //return $result;

    }

    public function signupEmail(Request $request){

        $selectIfEmailExist = SignupEmail::where('email', $request->txtSignupEmail)->get()->count();

        if($selectIfEmailExist == 0){
            $signupEmail = SignupEmail::insert([
                'email' => $request->txtSignupEmail
            ]);
            return ['message' => 'success'];
        }else{
            return ['message' => 'error'];
        }

    }

    public function sendEmail(Request $request){

        $sendEmailToSystem = Email::insert([
            'name' => $request->txtCustomerName,
            'email' => $request->txtEmail,
            'subject' => $request->txtSubject,
            'message' => $request->txtMessage,
        ]);

    }
    
    /**
    * Logout account
    */
    public static function logout(){

        Session::flush();

    }

}
