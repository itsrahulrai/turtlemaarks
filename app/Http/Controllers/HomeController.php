<?php
namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->take(4)->get();
        return view('frontend.index', compact('blogs'));
    }

    public function pages($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        // dd($page);
        return view('frontend.pages', compact('page'));
    }
 

    public function blogs()
    {
        $blogs = Blog::with('category')->latest()->paginate(9);
        return view('frontend.blogs', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::with('category')->where('slug', $slug)->firstOrFail();
        $recentBlogs = Blog::latest()->take(3)->get();
        $categories = Category::withCount('blogs')->get();

        // dd($blog, $recentBlogs, $categories );

        return view('frontend.blogs-details', compact('blog', 'recentBlogs', 'categories'));
    }

    public function category($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $blogs = Blog::with('category')
            ->where('category_id', $category->id)
            ->latest()
            ->paginate(6);
        $categories = Category::withCount('blogs')->get();
        return view('frontend.blogs', compact('blogs', 'categories', 'category'));
    }



public function contactSubmit(Request $request)
{
    // dd($request->all());
    // exit;
    // Validate form
    $validated = $request->validate([
        'name' => [
            'required',
            'string',
            'regex:/^[A-Za-z ]+$/',
            'max:255'
        ],

        'phone' => [
            'required',
            'digits:10'
        ],

        'email' => [
            'required',
            'email',
            'max:255'
        ],

        'message' => [
            'nullable',
            'string',
            'max:2000'
        ],
    ], [
        'name.required' => 'Name is required.',
        'name.regex' => 'Name should contain only letters and spaces.',

        'phone.required' => 'Phone number is required.',
        'phone.digits' => 'Phone number must be exactly 10 digits.',

        'email.required' => 'Email address is required.',
        'email.email' => 'Please enter a valid email address.',
    ]);

    $data = [
        'name' => $validated['name'],
        'mobile' => $validated['phone'],
        'email' => $validated['email'],
        'message' => $validated['message'] ?? '',
    ];

    try {

      $html = '
            <div style="font-family:Arial,sans-serif;background:#f4f8f8;padding:20px">

                <div style="
                    max-width:600px;
                    margin:auto;
                    background:#ffffff;
                    border-radius:10px;
                    overflow:hidden;
                    border:1px solid #e5e5e5;
                ">

                    <!-- Header -->
                    <div style="
                        background:#0C3C64;
                        color:#ffffff;
                        padding:18px;
                        text-align:center;
                    ">
                        <h2 style="margin:0;font-weight:600;">
                            Contact Enquiry
                        </h2>
                    </div>

                    <!-- Content -->
                    <div style="padding:25px;">

                        <p style="
                            margin-bottom:20px;
                            font-size:14px;
                            color:#333;
                        ">
                            You have received a new enquiry from the website.
                        </p>

                        <table
                            width="100%"
                            cellpadding="10"
                            cellspacing="0"
                            style="
                                border-collapse:collapse;
                                font-size:14px;
                                border:1px solid #eee;
                            "
                        >

                            <tr style="background:#eaf1f7;">
                                <td width="35%">
                                    <b>Name</b>
                                </td>
                                <td>
                                    ' . e($data['name']) . '
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Mobile</b>
                                </td>
                                <td>
                                    ' . e($data['mobile']) . '
                                </td>
                            </tr>

                            <tr style="background:#eaf1f7;">
                                <td>
                                    <b>Email</b>
                                </td>
                                <td>
                                    ' . e($data['email']) . '
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Message</b>
                                </td>
                                <td>
                                    ' . nl2br(e($data['message'])) . '
                                </td>
                            </tr>

                        </table>

                    </div>

                    <!-- Footer -->
                    <div style="
                        background:#0C3C64;
                        color:#ffffff;
                        padding:12px;
                        text-align:center;
                        font-size:12px;
                    ">
                        © ' . date('Y') . ' Turtle Maarks Hearing Health.
                        All rights reserved.
                    </div>

                </div>

            </div>';

        Mail::send([], [], function ($mail) use ($data, $html) {

            $mail->to('codersvox@gmail.com')
                ->replyTo(
                    $data['email'],
                    $data['name']
                )
                ->subject(
                    'New Enquiry - ' . $data['name']
                )
                ->from(
                    'codersvox@gmail.com',
                    'Turtle Maarks Hearing Health'
                )
                ->html($html);
        });

    } catch (\Throwable $e) {

        Log::error('Contact form mail failed', [
            'message' => $e->getMessage(),
            'file' => $e->getFile(),
            'line' => $e->getLine(),
        ]);

        return back()
            ->withInput()
            ->with(
                'error',
                'Unable to send your enquiry. Please try again.'
            );
    }

    // Redirect AFTER successful mail
    return redirect()
        ->route('thankyou')
        ->with(
            'success',
            'Your enquiry has been submitted successfully.'
        );
}
  

}
