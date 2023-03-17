<head>
    <title>ROdev | {{ $post->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! asset('css/welcome.css') !!}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <style>
        .container__ {
      width: min(100%, 1140px);
      margin: 1rem ;
    }
    
    .comment__container {
      display: none;
      position: relative;
      margin: 20px
    }
    
    .comment__container.opened {
      display: block;
    }
    
    .comment__container:not(:first-child) {
      margin-left: 3rem;
      margin-top: 1rem;
    }
    
    .comment__card {
      padding: 20px;
      background-color: white;
      border: 1px solid rgba(0, 0, 0, 0.3);
      border-radius: 0.5rem;
      min-width: 100%;
    }
    
    .comment__card h3,
    .comment__card p {
      margin-bottom: 2rem;
    }
    
    .comment__card-footer {
      display: flex;
      font-size: 0.85rem;
      opacity: 0.6;
      justify-content: flex-end;
      align-items: center;
      cursor: pointer;
      gap: 20px;
    }
    
    .show-replies {
      cursor: pointer;
    }
    </style>


</head>
<body>

    <header >
        <nav id="navbarwel" class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
          <div class="container container-fluid">
            <a class="navbar-brand" href="#">Ro-dev</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
      
              @if (Route::has('login'))
              <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                  @auth
                  <li class="nav-item">
                    <a href="{{ url('/') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" >Home</a>
                  </li>
                  <li class="nav-item">
                      <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline" >Control</a>
                  </li>
                  
                  @else
                  <li class="nav-item">
                      <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                  </li>
      
                      @if (Route::has('register'))
                      <li class="nav-item">
                          <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                      </li>
                      @endif
                  @endauth
                </ul>
          @endif
              
            </div>
          </div>
        </nav>
      </header>

      
    
    <div class="container text-center">
        <img src="{{ asset('/storage/public/images/'.$post->image) }}" alt="{{ $post->slug }}" class="imgslug w-50 " style="margin-top: 100px;box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 2px 6px 2px;">
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
            <button   type="button"  class="btn btn-sm btn-outline-secondary">Back to Home</button>
        </a>
    </div>


    {{-- comment --}}
    <section style="margin-top: 30xp" class="content-item" id="comment">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    @auth
                    <form action="{{route('comment',$post->slug)}}" method="POST" style="margin-bottom: 50px">
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
                                    <input type="hidden" name="parent_id" value="{{ $parent_id ?? null }}"> 

                                    <textarea class="inputcom form-control" name="content" id="message" placeholder="Your message" required=""></textarea>
                                    <button style="" type="submit" class="button-55 btn btn-normal pull-right" >Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                    @endauth
                    @guest
    <p>Silakan <a href="{{ route('login') }}">login</a> atau <a href="{{ route('register') }}">register</a> untuk
        mengomentari.</p>
@endguest
                    <h3 style=" font-family: Neucha, sans-serif; ">{{$comments->count()}} Comments</h3>

                    {{-- @foreach ($comments as $comment)
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
                                        
                                        <form style="float: left; margin-right: 10px ;" action="{{ route('comments.destroy', $comment->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>

                                        
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


                                </div>
                            </div>
                        </div>
                    @endforeach --}}




                    @foreach ($comments as $comment)
        {{-- {{ $comment }} --}}
            <div class="container__">
                @if ($comment->parent_id == null)
                <div class="comment__container opened" id="comment-{{ $comment->id }}">
                    <div class="comment__card">
                        <div class="comment__title">
                            <span class="fs-5 fw-bold">
                                <img src="{{ ($comment->user->gambar == null) ? asset('gambar/npc.jpg') : asset('storage/public/images/'.$comment->user->gambar) }}" class="rounded-circle" width="5%"> 
                                &nbsp; {{ $comment->user->nama }}
                            </span>
                            <span class="fs-6"> - {{ $comment->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <p>{{ $comment->content }}</p>
                        <div class="comment__card-footer">
                            @auth
                            @if ($comment->user->nama == auth()->user()->nama)
                            <div data-bs-toggle="collapse" data-bs-target="#editComment{{ $comment->id }}" aria-expanded="false" aria-controls="editComment{{ $comment->id }}">
                                Edit
                            </div>
                            <div class="delete-button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $comment->id }}').submit();">
                                Delete
                            </div>
                            <form id="delete-form-{{ $comment->id }}" action="{{ route('comments.destroy', ['id' => $comment->id]) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            @endif
                            <div data-bs-toggle="collapse" data-bs-target="#replyComment{{ $comment->id }}" aria-expanded="false" aria-controls="replyComment{{ $comment->id }}">
                                Reply
                            </div>
                            @endauth
                            <div class="show-replies">Show Reply</div>
                        </div>
                        <div class="collapse" id="editComment{{ $comment->id }}">
                            <form action="{{ route('comments.update', ['comment' => $comment->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <textarea 
                                class="form-control" 
                                id="content" 
                                name="content" 
                                class="form-control" 
                                maxlength="255"

                                oninput="document.getElementById('counter_update{{ $comment->id }}').textContent = (255 - this.value.length) + ' karakter tersisa'"
                                >{{ $comment->content }}</textarea>
                                <div id="counter_update{{ $comment->id }}"></div>
                            </div>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @auth
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endauth
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
{{-- input balas comen 1 --}}
                        <div class="collapse" id="replyComment{{ $comment->id }}">
                            <form action="{{ route('comment', ['post' => $post->slug]) }}" method="POST">
                            @csrf
                            @method('POST') {{-- menyesuaikan method router --}}
                            <div class="mb-3">
                
                                <textarea autofocus class="form-control" 
                                id="content" 
                                name="content"
                                maxlength="255"
                                oninput="document.getElementById('counter_reply_comment{{ $comment->id }}').textContent = (255 - this.value.length) + ' karakter tersisa'">{{ __('@:username ', ['username' => $comment->user->nama]) }}</textarea>
                                <div id="counter_reply_comment{{ $comment->id }}"></div>
                            </div>
                            @error('content')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @auth
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            @endauth
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                            <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                            <button type="submit" class="btn btn-primary">Send</button>
                            </form>
                        </div>
                    </div>

                    <div class="comment__container" dataset="comment-{{ $comment->id }}" id="reply-{{ $comment->id }}">
                        @if(count($comment->replies))
                        @foreach ($comment->replies as $reply)
                        <div class="comment__card">
                            <div class="comment__title">
                                <span class="fs-5 fw-bold">
                                    <img src="{{ ($reply->user->gambar == null) ? asset('images/null.jfif') : asset('storage/images/'.$reply->user->gambar) }}" class="rounded-circle" width="5%"> 
                                    &nbsp; {{ $reply->user->nama }}
                                </span> 
                                <span class="fs-6"> - {{ $reply->created_at->diffForHumans() }}</span>
                            </div>
                            <p>{{ $reply->content }}</p>
                            <div class="comment__card-footer">
                                @auth
                                @if ($reply->user->nama == auth()->user()->nama)
                                <div data-bs-toggle="collapse" data-bs-target="#editReplyComment{{ $reply->id }}" aria-expanded="false" aria-controls="editReplyComment{{ $reply->id }}">
                                    Edit
                                </div>
                                <div class="delete-button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $reply->id }}').submit();">
                                    Delete
                                </div>
                                <form id="delete-form-{{ $reply->id }}" action="{{ route('comments.destroy', ['id' => $reply->id]) }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                                <div data-bs-toggle="collapse" data-bs-target="#replyReplyComment{{ $reply->id }}" aria-expanded="false" aria-controls="replyReplyComment{{ $reply->id }}">
                                    Reply
                                </div>
                                @endauth
                                <div class="show-replies">Show Reply</div>
                            </div>

                            <div class="collapse" id="editReplyComment{{ $reply->id }}">
                                <form action="{{ route('comments.update', ['comment' => $reply->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <textarea 
                                    class="form-control" 
                                    id="content" 
                                    name="content" 
                                    class="form-control" 
                                    maxlength="255"
                                    oninput="document.getElementById('reply_update{{ $comment->id }}').textContent = (255 - this.value.length) + ' karakter tersisa'"
                                    >{{ $comment->content }}</textarea>
                                    <div id="reply_update{{ $comment->id }}"></div>
                                </div>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @auth
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <button type="submit" class="btn btn-primary">Update</button>
                                </form>
                            </div>
{{-- input balas komen 2 --}}
                            <div class="collapse" id="replyReplyComment{{ $reply->id }}">
                                <form action="{{ route('comment', ['post' => $post->slug]) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="mb-3">
                                    <textarea autofocus class="form-control" 
                                    id="content" 
                                    name="content"
                                    maxlength="255"
                                    oninput="document.getElementById('reply_reply_comment{{ $comment->id }}').textContent = (255 - this.value.length) + ' karakter tersisa'">{{ __('@:username ', ['username' => $comment->user->nama]) }}</textarea>
                                    <div id="reply_reply_comment{{ $comment->id }}"></div>
                                </div>
                                @error('content')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @auth
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                @endauth
                                <input type="hidden" name="post_id" value="{{ $post->id }}">
                                <input type="hidden" name="parent_id" value="{{ $reply->id }}">
                                <button type="submit" class="btn btn-primary">Send</button>
                                </form>
                            </div>
                        </div>

                        <div class="comment__container"  dataset="reply-{{ $comment->id }}" id="reply-reply-{{ $reply->id }}">
                        @if ($reply->replies)
                            @foreach ($reply->replies as $reply2)
                                <div class="comment__card">
                                    <div class="comment__title">
                                        <span class="fs-5 fw-bold">
                                            <img src="{{ ($reply2->user->pp == null) ? asset('images/null.jfif') : asset('storage/images/'.$reply2->user->pp) }}" class="rounded-circle" width="5%"> 
                                            &nbsp; {{ $reply2->user->nama }}
                                        </span> 
                                        <span class="fs-6">
                                            - {{ $reply2->created_at->diffForHumans() }}
                                        </span>
                                        </div>
                                    <p>{{ $reply2->content }}</p>
                                    <div class="comment__card-footer">
                                        @auth
                                        @if ($reply2->user->nama == auth()->user()->nama)
                                        <div data-bs-toggle="collapse" data-bs-target="#editReplyReplyComment{{ $reply2->id }}" aria-expanded="false" aria-controls="editReplyReplyComment{{ $reply2->id }}">
                                            Edit
                                        </div>
                                        <div class="delete-button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $reply2->id }}').submit();">
                                            Delete
                                        </div>
                                        <form id="delete-form-{{ $reply2->id }}" action="{{ route('comments.destroy', ['id' => $reply2->id]) }}" method="POST" class="d-none">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                        @endauth
                                    </div>
                                    <div class="collapse" id="editReplyReplyComment{{ $reply2->id }}">
                                        <form action="{{ route('comments.update', ['comment' => $reply2->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="mb-3">
                                            <textarea 
                                            class="form-control" 
                                            id="content" 
                                            name="content" 
                                            class="form-control" 
                                            oninput="document.getElementById('reply_reply_update{{ $comment->id }}').textContent = (255 - this.value.length) + ' karakter tersisa'"
                                            >{{ $comment->content }}</textarea>
                                            <div id="reply_reply_update{{ $comment->id }}"></div>
                                        </div>
                                        @error('content')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @auth
                                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                        @endauth
                                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                @endif
            </div>
        @endforeach
                

                </div>
            </div>
        </div>
    </section>
    
    



</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
{{-- <script>function showUpdateForm(commentId) {
    var form = document.getElementById('update-comment-' + commentId);
    form.style.display = 'block';
}</script> --}}
<script>
    function dis() {
        document.getElementById('btn-submit').setAttribute('disabled', true);
    }
    const showContainers = document.querySelectorAll(".show-replies");
    showContainers.forEach((btn) =>
    btn.addEventListener("click", (e) => {
        let parentContainer = e.target.closest(".comment__container");
        let _id = parentContainer.id;
        if (_id) {
        let childrenContainer = parentContainer.querySelectorAll(
            `[dataset=${_id}]`
        );
        childrenContainer.forEach((child) => child.classList.toggle("opened"));
        }
    })
    );



</script>



