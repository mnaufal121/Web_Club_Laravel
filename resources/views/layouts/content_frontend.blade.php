<div class="container valign">
    <div class="panel panel-default">
        <table>
            <tr>
                <?php $last = App\Models\Resep::where('id', '>', '0')->orderBy('id', 'desc')->paginate(4); ?>@foreach($last as $las)
                <td class="colomn">
                    <a href="" style="color: #000">
                        <imgsrc="gambar\ {{$las -> gambar}}" width="200">
                            <br>
                            <h3>{{$las->judul}}</h3>
                    </a>
                </td> @endforeach
            </tr>
        </table>
        <table>
            <tr>
                <?php $lastv = App\Models\Video::where('id', '>', '0')->orderBy('id', 'desc')->paginate(4); ?>@foreach($lastv as $vid)
                <td class="colomn">
                    <a href="" style="color: #000">
                        {!!$vid->video !!}
                        <h3>{{$vid->judul}}</h3>
                    </a>
                </td> @endforeach
            </tr>
        </table>
    </div>
</div>
<style type="text/css">
    .valign {
        position: absolute;
        left: 40%;
        top: 65%;
        transform: translate(-50%, -50%);
    }

    .panel {
        border-radius: 0;
    }

    .panel .colomn {
        position: relative;
        left: 25%;
        padding: 25;
    }
</style>