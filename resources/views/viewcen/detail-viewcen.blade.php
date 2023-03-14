<head>
    <title>ROdev | {{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('css/welcome.css') !!}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
    
    <div class="container text-center">
        <img src="{{ asset('/storage/public/images/'.$post->image) }}" alt="{{ $post->slug }}" class="imgslug w-50 mt-5">
        <h4 class="mt-4">{{ $post->title }}</h4>
        <p>{!! $post->content !!}</p>

        {!! $share !!}

        <p>Views: {{ $post->views }}</p>


        {{-- saved --}}
        @if (auth()->check())
            @if (auth()->user()->SavePost->contains('post_id', $post->id))
                <form action="{{ route('post-saves.destroy', ['post' => $post->id]) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-sm" >Unsave</button>
                </form>
            @else
                <form action="{{ route('post-saves.store', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Save</button>
                </form>
            @endif
        @endif
        
        {{-- like --}}
        @if (auth()->check())
            @if (auth()->user()->Like->contains('post_id', $post->id))
                <form action="{{ route('likes.destroy', ['post' => $post->id]) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary btn-sm" >Unlike</button>
                </form>
            @else
                <form action="{{ route('likes.store', ['post' => $post->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Like</button>
                </form>
            @endif
        @endif

        <a href="/">
            <button   type="button"  class="btn btn-sm btn-outline-secondary">Back</button>
        </a>
    </div>


    {{-- comment --}}
    <section style="margin-top: 30xp" class="content-item" id="comment">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <form action="{{route('comment')}}" method="POST" style="margin-bottom: 50px">
                        @csrf
                        <h3 style=" font-family: Neucha, sans-serif;" class="pull-left" >Comment</h3>
                        
                        <fieldset>
                            <div class="row">
                                <div class="col-sm-3 col-lg-2 hidden-xs">
                                    @if (Auth::user()->gambar)
                                        <img class="imagecoms img-responsive" src="{{ asset('storage/public/images/' . Auth::user()->gambar) }}"
                                            width="100" alt="">
                                    @else
                                        <img class="imagecoms img-responsive"
                                            src="{{ asset('gambar/npc.jpg') }}" width="100"
                                            alt="">
                                    @endif
                                </div>
                                <div class="form-group col-xs-12 col-sm-9 col-lg-10">
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">  
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                    <textarea class="inputcom form-control" name="content" id="message" placeholder="Your message" required=""></textarea>
                                    <button style="" type="submit" class="button-55 btn btn-normal pull-right">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                        
                    </form>
                    <h3 style=" font-family: Neucha, sans-serif; ">{{$comments->count()}} Comments</h3>

                    @foreach ($comments as $comment)
                        <hr>

                        <div class="media">
                            <img class="imagecoms img-responsive" src="{{ asset('storage/public/images/' . $comment->user->gambar) }}"
                                width="100" alt="">
                            <div class="media-body" >
                                <h4 style=" font-family: Neucha, sans-serif; " class="media-heading mt-4">{{ $comment->user->nama }}</h4>
                                <p>{{ $comment->content }}</p>
                                    <ul class="list-unstyled list-inline media-detail pull-left">
                                        <li><small><i class="fa fa-calendar"></i> {{ $comment->created_at }}</small></li>
                                    </ul>
                                <div class="pull-right">
                                    @if ($comment->user_id == Auth::user()->id)
                    {{-- hapus --}}
                    <form style="float: left; margin-right: 10px ;" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>

                    {{-- edit --}}
                    <button style="" type="button" class="btn btn-primary" onclick="showUpdateForm('{{ $comment->id }}')">Edit</button>

                    <form id="update-comment-{{ $comment->id }}" action="{{ route('comments.update', $comment->id) }}" method="POST" style="display: none;">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <textarea class="form-control" id="content" name="content" rows="3">{{ $comment->content }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16">
                            <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                        </svg></button>
                    </form>
                @endif
                                    {{-- <form action="{{ route('comments.update', $comment->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="content">Content</label>
                                            <textarea class="form-control" id="content" name="content" rows="3">{{ $comment->content }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form> --}}
                                    
                                
                                </div>
                            </div>
                        </div>
                    @endforeach
                

                </div>
            </div>
        </div>
    </section>
    
    



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>function showUpdateForm(commentId) {
    var form = document.getElementById('update-comment-' + commentId);
    form.style.display = 'block';
}</script>