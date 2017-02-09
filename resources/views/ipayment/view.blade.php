<div class="row">
  <div class="col-sm-5">
    <div class="white-box">
      <h1 class="box-title">{{ $data->nama }}</h1>
      <div>
        <div>Nomor Telepon</div>
        <div>{{ $data->phone }}</div>
      </div>
      <div>
        <div>Nomor Internet</div>
        <div>{{ $data->internet }}</div>
      </div>
      <div>
        <div>Produk</div>
        <div>{{ $data->groupId }}</div>
      </div>
    </div>
  </div>
  <div class="col-sm-7">
    <?php $latest = $data->history[0] ?>
    <div class="white-box">
      <h1 class="box-title">{{ $latest->periode }}</h1>
      <ul class="list-icons">
        @foreach($latest->detail as $detail)
          <li>
            @if ($detail->statusBayar == 'Lunas')
              <i class="fa fa-check-square-o text-success"></i>
            @else
              <i class="fa fa-square-o"></i>
            @endif
            <span>{{ $detail->layanan }}</span>
            <span>{{ $detail->tagihan }}</span>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xs-4 col-sm-3"></div>
</div>
