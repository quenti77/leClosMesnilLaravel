<?php


use App\Http\Controllers\CategoryController;
use App\Optimizer\OptimizerChainFactory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;

class MyLogger implements Psr\Log\LoggerInterface {


    public function emergency(\Stringable|string $message, array $context = [])
    {
        $this->log( 'emergency',$message,$context);
    }

    public function alert(\Stringable|string $message, array $context = [])
    {
        $this->log( 'alert',$message,$context);
    }

    public function critical(\Stringable|string $message, array $context = [])
    {
        $this->log( 'critical',$message,$context);
    }

    public function error(\Stringable|string $message, array $context = [])
    {
        $this->log( 'error',$message,$context);
    }

    public function warning(\Stringable|string $message, array $context = [])
    {
        $this->log( 'warning',$message,$context);
    }

    public function notice(\Stringable|string $message, array $context = [])
    {
        $this->log( 'notice',$message,$context);
    }

    public function info(\Stringable|string $message, array $context = [])
    {
        $this->log( 'info',$message,$context);
    }

    public function debug(\Stringable|string $message, array $context = [])
    {
        $this->log( 'debug',$message,$context);
    }

    public function log($level, \Stringable|string $message, array $context = [])
    {
        dump($level,$message,$context);
    }
}

Route::get('/', [PostController::class, 'index'])->name('index')->middleware('verified');
Route::get('/posts', [PostController::class, 'getPost']);
Route::get('/category', [PostController::class, 'getCategory']);

//Route::get('/posts', [PostController::class, 'index'])->name('post.index');
Route::get('/post/{slug}', [PostController::class, 'show'])->where('slug', '[\w\d\-\_]+')->name('post.show');
Route::get('/post/{slug}#comment', [PostController::class, 'show'])->where('slug', '[\w\d\-\_]+')->name('post.comment');

Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comment.store');
Route::patch('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');

Auth::routes(['verify' => true]);
