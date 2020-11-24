<div class="row" id="body-row">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <ul class="list-group">
            <h2 id="latest_resep">Latest Resep</h2>
            <?php $last = App\Models\Resep::where('id', '>', '0')->orderBy('id', 'desc')->paginate(1); ?>@foreach($last as $las)
            <a href="" style="color: #000">
                <img src="gambar/{{$las->gambar}}" width="150">
                <br>
                <h4>{{$las->judul}}</h4>
            </a> @endforeach
            <h2 id="latest_resep">Latest Video</h2>
            <?php $vids = App\Models\Video::where('id', '>', '0')->orderBy('id', 'desc')->paginate(1); ?>@foreach($vids as $vid)
            <a href="" style="color: #000"> {!!$vid->video !!}
                <h4>{{$vid->judul}}</h4>
            </a> @endforeach
        </ul>
    </div>
</div>
<style type="text/css">
    #body-row {
        margin-left: 0;
        margin-right: 0;
    }

    #sidebar-container {
        min-height: 100vh;
        background-color: #ff5a0b;
        padding: 0;
    }

    .sidebar-expanded {
        width: 230px;
    }

    .sidebar-collapsed {
        width: 60px;
    }

    #latest_resep {
        padding: 15;
    }
</style>