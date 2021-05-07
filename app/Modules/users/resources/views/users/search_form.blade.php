<!--begin: Search Form -->
<form class="kt-form kt-form--fit col-12 kt-padding-l-10 kt-margin-r-10 kt-margin-t-20 align-items-center" method="get" action="{{route('users.index')}}">
    <div class="kt-margin-b-20 row col-12">
        <div class="row col-12">
            <div class="col-lg-12 kt-margin-b-10-tablet-and-mobile ">
                    <div class="col-4 mb-3">
                        {!! Form::label('inventory_tags', 'Inventory Tag :',['class' => 'font-weight-bold text-break']) !!}

                    </div>
                <div class="form-group form-group-last row"></div>
            </div>
        </div>
        <div class="col-4 col-md justify-content-md-end">
            <button class="btn btn-primary btn-brand--icon col-md-4 col" id="kt_search">
                    <span>
                        <i class="la la-search"></i>
                        <span>Filter</span>
                    </span>
            </button>
            &nbsp;&nbsp;                <input name="search">

            <a class="btn btn-secondary btn-secondary--icon col-md-4 col" href="{{route('users.index')}}" >
                    <span>
                        <i class="la la-close"></i>
                        <span>Reset</span>
                    </span>
            </a>
        </div>
        <input type="text" name="filter" hidden value="filter">
    </div>
</form>

