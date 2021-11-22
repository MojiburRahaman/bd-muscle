@extends('frontend.master')

@section('content')
  <!-- .breadcumb-area start -->
  <div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Blog Page</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Blog</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- blog-area start -->
<div class="blog-area">
    <div class="container">
        <div class="col-lg-12">
            <div class="section-title  text-center">
                <h2>Latest News</h2>
                <img src="assets/images/section-title.png" alt="">
            </div>
        </div>
        <div class="row">
            @forelse ($blogs as $blog)
                
            <div class="col-lg-4  col-md-6 col-12">
                <div class="blog-wrap">
                    <div class="blog-image">
                        <img src="{{asset('blogs/thumbnail/'.$blog->blog_thumbnail)}}" alt="{{Str::ucfirst($blog->title)}}">
                        <ul>
                            <li>{{$blog->created_at->format('d')}}</li>
                            <li>{{$blog->created_at->format('M')}}</li>
                        </ul>
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <ul>
                                <li class="pull-right"><a ><i class="fa fa-clock-o"></i> {{$blog->created_at->format('d/m/y')}}</a></li>
                            </ul>
                        </div>
                        <h3><a href="{{route('FrontenblogView',$blog->slug)}}">{{Str::ucfirst($blog->title)}}</a></h3>
                        {{-- <p>{!! Str::ucfirst(Str::limit($blog->blog_description,100)) !!}</p> --}}
                    </div>
                </div>
            </div>
            @empty
                
            @endforelse
         
            <div class="col-12">
               {{$blogs->links('frontend.paginator')}}
            </div>
        </div>
    </div>
</div>
<!-- blog-area end -->
@endsection

