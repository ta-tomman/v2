@extends('app')

@section('body')
  <div class="white-box">
    <ul class="list-icons">
      <li>
        <i data-icon="&#xe04b;" class="linea-icon linea-aerrow"></i>
        <span>Regional I</span>

        <ul>
          <li>
            <i class="line-icon linea-aerrow" data-icon="&#xe01b;"></i>
            <span>Witel I</span>

            <ul>
              <li>
                <i class="line-icon linea-aerrow" data-icon="&#xe01b;"></i>
                <span>Area I</span>
              </li>
            </ul>
          </li>

          <li>
            <i class="line-icon linea-aerrow" data-icon="&#xe01b;"></i>
            <span>Witel II</span>
          </li>
        </ul>
      </li>

      <li>
        <i data-icon="&#xe04b;" class="linea-icon linea-aerrow"></i>
        <span>Regional II</span>
      </li>
    </ul>
  </div>
@endsection
