@extends(AdminTheme::wrapper(), ['title' => __('SocialLinks Config'), 'keywords' => 'WemX Dashboard, WemX Panel'])

@section('css_libraries')
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.css')) }}" />
    <link rel="stylesheet" href="{{ asset(AdminTheme::assets('modules/select2/dist/css/select2.min.css')) }}">

@endsection

@section('js_libraries')
    <script src="{{ asset(AdminTheme::assets('modules/summernote/summernote-bs4.js')) }}"></script>
    <script src="{{ asset(AdminTheme::assets('modules/select2/dist/js/select2.full.min.js')) }}"></script>
@endsection

@section('container')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header d-flex justify-content-between text-bold align-items-center">
                    <h4>SocialLinks Config</h4>
                    <hr>



                </div>

                <div class="card-body">

                    <div class="card-body">
                        <form action="{{ route('admin.settings.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-12">

                            </div>
                            <div class="form-group col-12">
                                <label>Discord Link</label>
                                <input type="text" name="sociallinks::discord" value="@settings('sociallinks::discord', '/')" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Github Link</label>
                                <input type="text" name="sociallinks::github" value="@settings('sociallinks::github', '/')" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Twitter Link</label>
                                <input type="text" name="sociallinks::twitter" value="@settings('sociallinks::twitter', '/')" class="form-control">
                            </div>

                            {{-- Added in 1.1 | More Links --}}

                            <div class="form-group col-12">
                                <label>TikTok Link</label>
                                <input type="text" name="sociallinks::tiktok" value="@settings('sociallinks::tiktok', '/')" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Gamepanel Link</label>
                                <input type="text" name="sociallinks::gamepanel" value="@settings('sociallinks::gamepanel', '/')" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Instagram Link</label>
                                <input type="text" name="sociallinks::instagram" value="@settings('sociallinks::instagram', '/')" class="form-control">
                            </div>
                            <div class="form-group col-12">
                                <label>Youtube Link</label>
                                <input type="text" name="sociallinks::youtube" value="@settings('sociallinks::youtube', '/')" class="form-control">
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-right">

                        <button type="submit" class="btn btn-primary">{!! __('admin.submit') !!}</button>
                    </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
