@extends('app')

@section('body')
  <div class="white-box">
    <div class="row">
      <div class="col-sm-6">
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

                  <li>
                    <i class="linea-icon linea-aerrow" data-icon="&#xe072;"></i>
                    <form method="post" style="display: inline-block">
                      <input type="text" class="form-control" style="width:150px; display: inline">
                      <button class="btn btn-primary">
                        <i class="fa fa-plus"></i>
                      </button>
                    </form>
                  </li>
                </ul>
              </li>

              <li>
                <i class="line-icon linea-aerrow" data-icon="&#xe01b;"></i>
                <span>Witel II</span>
              </li>

              <li>
                <i class="linea-icon linea-aerrow" data-icon="&#xe072;"></i>
                <form method="post" style="display: inline-block">
                  <input type="text" class="form-control" style="width:150px; display: inline">
                  <button class="btn btn-primary">
                    <i class="fa fa-plus"></i>
                  </button>
                </form>
              </li>
            </ul>
          </li>

          <li>
            <i data-icon="&#xe04b;" class="linea-icon linea-aerrow"></i>
            <span>Regional II</span>
          </li>

          <li>
            <i class="linea-icon linea-aerrow" data-icon="&#xe072;"></i>
            <form method="post" style="display: inline-block">
              <input type="text" class="form-control" style="width:150px; display: inline">
              <button class="btn btn-primary">
                <i class="fa fa-plus"></i>
              </button>
            </form>
          </li>
        </ul>
      </div>

      <div class="col-sm-6">
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

                  <li>
                    <i data-icon="&#xe00d;" class="linea-icon linea-aerrow"></i>
                    <button class="btn-link">add</button>
                  </li>
                </ul>
              </li>

              <li>
                <i class="line-icon linea-aerrow" data-icon="&#xe01b;"></i>
                <span>Witel II</span>
              </li>

              <li>
                <i data-icon="&#xe00d;" class="linea-icon linea-aerrow"></i>
                <button class="btn-link">add</button>
              </li>
            </ul>
          </li>

          <li>
            <i data-icon="&#xe04b;" class="linea-icon linea-aerrow"></i>
            <span>Regional II</span>
          </li>

          <li>
            <i data-icon="&#xe00d;" class="linea-icon linea-aerrow"></i>
            <button class="btn-link">add</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection
