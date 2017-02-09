@extends('bot')

@section('style')
  <style>
    .flex-container {
      display: flex;
      align-items: stretch;
      align-content: stretch;
    }
    .flex-container > div {
      margin: 10px;
      flex-grow: 1;
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
      margin-bottom: 10px;
    }

    .history-previous {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
      margin-top: 30px;
    }
    .history-previous > div {
      margin: 10px;
      flex-grow: 1;
    }
  </style>
@endsection

@section('body')
  <div class="flex-container">
    <div class="card">
      <h1>{{ $data->nama }}</h1>

      <div class="entry">
        <div>Nomor Telepon</div>
        <div class="text-big">{{ $data->phone }}</div>
      </div>
      <div class="entry">
        <div>Nomor Internet</div>
        <div class="text-big">{{ $data->internet }}</div>
      </div>
      <div class="entry">
        <div>Produk</div>
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
        <div class="entry clearfix">
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
      @endforeach
    </div>
  </div>

  <div class="history-previous">
    <?php $max = min(11, count($data->history)) ?>
    @for($i = 1; $i < $max; $i++)
      <?php $entry = $data->history[$i] ?>
      <?php $class = ($entry->statusBayar == 'Lunas') ? 'panel-success' : '' ?>
      <div class="panel {{ $class }}">
        <div class="panel-heading">{{ $entry->periode }}</div>
        <div class="panel-body">Rp {{ $entry->tagihan }}</div>
      </div>
    @endfor
  </div>
@endsection
