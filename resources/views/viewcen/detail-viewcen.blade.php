<head>
    <title>{{ $post->title }}</title>
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

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>