@extends('frontend.master')

@section('title')
{{$blog->title}}
@endsection
@section('meta_description')
{{$blog->title}}
@endsection
@section('content')
<style>
    .comment_btn {
	width: 125px;
	color: #fff;
	text-transform: uppercase;
	padding: 0;
	background: #333;
	cursor: pointer;
	margin: 30px 0px 0px;
    height: 40px;
}
</style>
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Blog Details</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Blog Details</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- blog-details-area start-->
<div class="blog-details-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-12">
                <div class="blog-details-wrap">
                    <img src="{{asset('blogs/blog_image/'.$blog->blog_image)}}" alt="{{$blog->title}}">
                    <h3>{{$blog->title}}</h3>
                    <ul class="meta">
                        <li>{{$blog->created_at->format('d M y')}}</li>
                        <li>By Admin</li>
                    </ul>
                    <p>{!! $blog->blog_description !!}</p>
                    <div class="share-wrap">
                        <div class="row">
                            <div class="col-sm-7 ">
                                <ul class="socil-icon d-flex">
                                    <li>share it on :</li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                            @if ($next)
                            <div class="col-sm-5 text-right">
                                <a href="{{route('FrontenblogView',$next->slug)}}">Next Post <i
                                        class="fa fa-long-arrow-right"></i></a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="comment-form-area">
                    <div class="comment-main">
                        <h3 class="blog-title"><span>({{$blog->blog_comment_count}})</span>Comments:</h3>
                        <ol class="comments">
                            <li class="comment even thread-even depth-1">
                                @forelse ($blog->BlogComment as $comment )
                                    
                                <div class="comment-wrap">
                                    <div class="comment-main-area">
                                        <div class="comment-wrapper">
                                            <div class="sewl-comments-meta">
                                                <h4>{{$comment->user_name}} </h4>
                                                <span>{{$comment->created_at->format('d M Y')}}</span>
                                            </div>
                                            <div class="comment-area">
                                                <p>{{$comment->comment}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    
                                @endforelse
                            </li>
                        </ol>
                    </div>
                    <div id="respond" class="sewl-comment-form comment-respond form-style">
                        <h3 id="reply-title" class="blog-title">Leave a <span>comment</span></h3>
                        <form method="post" id="commentform" class="comment-form" action="{{route('BlogComment')}}">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="sewl-form-inputs no-padding-left">
                                        <div class="row">
                                            <div class="col-sm-6 col-12">
                                                <input id="name" name="user_name" value="" tabindex="2" placeholder="Name"
                                                    type="text">
                                            </div>
                                            <div class="col-sm-6 col-12">
                                                <input id="email" name="email" value="" tabindex="3" placeholder="Email"
                                                    type="email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <input type="hidden" name="blog_id" value="{{$blog->id}}">
                                    <div class="sewl-form-textarea no-padding-right">
                                        <textarea id="comment" name="comment" tabindex="4" rows="3" cols="30"
                                            placeholder="Write Your Comments..."></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-submit">
                                        <button class="btn comment_btn" type="submit">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-12">
                <aside class="sidebar-area">
                    <div class="widget widget_recent_entries recent_post">
                        <h4 class="widget-title">Recent Post</h4>
                        <ul>
                            @forelse ($blogs as $recent_blog)

                            <li>
                                <div class="post-img">
                                    <a href="{{route('FrontenblogView',$recent_blog->slug)}}"">
                                    <img width=" 80px" src="{{asset('blogs/thumbnail/'.$recent_blog->blog_thumbnail)}}"
                                        alt="{{Str::ucfirst($recent_blog->title)}}">
                                    </a>
                                </div>
                                <div class="post-content">
                                    <a
                                        href="{{route('FrontenblogView',$recent_blog->slug)}}">{{Str::ucfirst($recent_blog->title)}}</a>
                                    <p>{{$recent_blog->created_at->format('d M y')}}</p>
                                </div>
                            </li>
                            @empty
                            <li> No Recent Blogs</li>
                            @endforelse
                            <li><a href="{{route('Frontendblog')}}">See More blogs..</a></li>
                        </ul>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- blog-details-area end -->
@endsection