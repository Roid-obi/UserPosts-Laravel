<head>
    <title>ROdev | {{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    
    <div class="container text-center">
        <img src="{{ asset('/storage/public/images/'.$post->image) }}" alt="{{ $post->slug }}" class="w-50 pt-5">
        <h4 class="mt-4">{{ $post->title }}</h4>
        <p>{!! $post->content !!}</p>
        <a href="/">
            <button   type="button"  class="btn btn-sm btn-outline-secondary">Back</button>
          </a>
    </div>


    {{-- comment --}}
    <section class="content-item" id="comment">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form action="{{route('comment')}}" method="POST">
                        @csrf
                        <h3 class="pull-left">Comment</h3>
                        
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2 hidden-xs">
                                    @if (Auth::user()->gambar)
                                        <img class="img-responsive" src="{{ asset('storage/public/images/' . Auth::user()->gambar) }}"
                                            width="100" alt="">
                                    @else
                                        <img class="img-responsive"
                                            src="{{ asset('images/person-default-23122312.gif') }}" width="100"
                                            alt="">
                                    @endif
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">  
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <textarea class="form-control" name="content" id="message" placeholder="Your message" required=""></textarea>
                                    <button style="margin-top: 20px;" type="submit" class="btn btn-normal pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                        
                    </form>
                    <h3>{{$comments->count()}} Comments</h3>

                    @foreach ($comments as $item)
                    <div class="media">
                        <img style="float: left; margin-right:20px;" class="img-responsive" src="{{ asset('storage/public/images/' . $item->user->gambar) }}"
                        width="100" alt="">
                        <div class="media-body" >

                            <h4 class="media-heading mt-4">{{$item->user->nama}}</h4>
                            <p>{{$item->content}}
                            </p>
                            <ul class="list-unstyled list-inline media-detail pull-left">
                                <li><i class="fa fa-calendar"></i>{{$item->created_at}}</li>
                            </ul>
                        </div>
                    </div>

                    @endforeach

                </div>
            </div>
        </div>
    </section>
    
    



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>