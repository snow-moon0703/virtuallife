<div class="row">
    <div class="col-md-12 col-sm-12 col-12 text-right">
        <form action="{{ url()->current() }}" method="get" class="form-inline justify-content-end">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" value="{{request('search')}}" aria-label="Search" name="search">
            <button class="btn btn-outline-info my-2" type="submit">{{ __('Search') }}</button>
        </form>
    </div>
</div>