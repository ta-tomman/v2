@extends('bot')

@section('style')
  <style>
    .flex-container {
      display: table;
      width: 103%;
      border-spacing: 10px;
      margin: -10px -10px 20px -10px;
    }
    .flex-container > div {
      display: table-cell;
      width: 45%;
    }
    .card {
      background-color: #fff;
      box-shadow: 0 2px 2px 0 rgba(0,0,0,.14), 0 3px 1px -2px rgba(0,0,0,.2), 0 1px 5px 0 rgba(0,0,0,.12);
      border: 1px solid rgba(0,0,0,.12);
      padding: 10px;
    }
    .entry > div:first-child {
      color: black;
    }
    .text-big {
      font-size: 24px;
      font-weight: 500;
    }
    .entry {
      margin-bottom: 17px;
    }
  </style>
@endsection

@section('body')
  <div class="flex-container">
    <div class="card">
      <h1>{{ $data->nama }}</h1>

      <div class="entry">
        <div>NOMOR TELEPON</div>
        <div class="text-big">{{ $data->phone }}</div>
      </div>
      <div class="entry">
        <div>NOMOR INTERNET</div>
        <div class="text-big">{{ $data->internet }}</div>
      </div>
      <div class="entry">
        <div>PRODUK</div>
        <div class="text-big">
          <?php $token = preg_match('/\(([^)]+)\)/', $data->groupId, $matches) ?>
          {{ $matches[1] or $data->groupId }}
        </div>
      </div>
    </div>

    <div class="card">
      <?php $latest = $data->history[0] ?>
      <h1>{{ $latest->periode }}</h1>

      @foreach($latest->detail as $detail)
        <div>
          <div>{{ $detail->layanan }}</div>
          <div class="text-big pull-left">Rp</div>
          <div class="text-big pull-right">
            <span>{{ $detail->tagihan }}</span>
            @if ($detail->statusBayar == 'Lunas')
              <i class="fa fa-check-square-o text-success"></i>
            @else
              <i class="fa fa-square-o"></i>
            @endif
          </div>
        </div>
        <div class="clearfix"></div>
      @endforeach
    </div>
  </div>

  <div class="history-previous row">
    {{-- Start from index 1; ignores first entry (index 0) --}}
    @for($i = 1; $i < count($data->history); $i++)
      <?php $entry = $data->history[$i] ?>
      <?php $class = ($entry->statusBayar == 'Lunas') ? 'success' : 'inverse' ?>
      <div class="col-xs-4">
        <div class="panel panel-{{ $class }}">
          <div class="panel-heading">{{ $entry->periode }}</div>
          <div class="panel-body text-big">
            @if ($entry->statusBayar == 'Lunas')
              <i class="fa fa-check-square-o text-success"></i>
            @else
              <i class="fa fa-square-o"></i>
            @endif
            Rp {{ $entry->tagihan }}
          </div>
        </div>
      </div>
    @endfor
  </div>
@endsection
