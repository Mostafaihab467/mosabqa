<div class="card shadow-sm">
    <div class="card-header collapsible cursor-pointer rotate {{@$filter->search!="1" ? "collapsed" : "active"}}"
         data-bs-toggle="collapse"
         data-bs-target="#kt_docs_card_collapsible">
        <h3 class="card-title"> {{__("admin.system.translations.Search")}}</h3>
        <div class="card-toolbar rotate-180">
            <span class="svg-icon svg-icon-1">
                ...
            </span>
        </div>
    </div>
    <div id="kt_docs_card_collapsible" class="collapse {{@$filter->search!="1" ? "" : "show"}}">
        <div class="card-body">
            <form class="kt-form" method="GET" name="SearchForm" id="SearchForm">
                <input type="hidden" name="search" value="1">
                <div class="form-group row">
                    {{-- find in --}}
                    <div class="col-lg-8 mb-3">
                        <label for="find_in_field">{{__("admin.system.translations.Find in")}}:</label>
                        <div class="input-group">
                            <select name="find_in_field" id="find_in_field" class="form-select form-select-solid fw-bold col-lg-3">
                                <option value="translation_key" {{@$filter->find_in_field=="translation_key" ? "selected" : ""}}>
                                    {{__("admin.system.translations.Translation key")}}
                                </option>

                                <option value="translations_raw" {{@$filter->find_in_field=="translations" ? "selected" : ""}}>
                                    {{__("admin.system.translations.Translation")}}
                                </option>
                            </select>
                            <select name="find_in_operator" id="find_in_operator" class="form-select col-lg-3">
                                <option value="contain" {{@$filter->find_in_operator=="contain" ? "selected" : ""}}>
                                    {{__('admin.system.translations.Contain')}}
                                </option>
                                <option value="equal_to" {{@$filter->find_in_operator=="equal_to" ? "selected" : ""}}>
                                    {{__('admin.system.translations.Equal to')}}
                                </option>
                                <option value="start_with" {{@$filter->find_in_operator=="start_with" ? "selected" : ""}}>
                                    {{__('admin.system.translations.Start with')}}
                                </option>
                                <option value="end_with" {{@$filter->find_in_operator=="end_with" ? "selected" : ""}}>
                                    {{__('admin.system.translations.End with')}}
                                </option>
                            </select>
                            <input type="text" name="find_in_value" id="find_in_value" maxlength="255" value="{{@$filter->find_in_value}}" class="form-control col-lg-6" aria-describedby="" placeholder="">
                        </div>
                    </div>

                    {{-- Site --}}
                    <div class="col-lg-2 mb-3">
                        <label for="site_id">{{__("admin.system.translations.Site")}}:</label>
                        <select name="site_id" id="site_id" class="form-select">
                            <option value="">
                                {{__("admin.system.translations.Please select")}}
                            </option>
                            @foreach(sites() as $key => $siteItem)
                                <option value="{{$key}}" {{old('site_id', @$filter->site_id) === $key ? "selected" : "" }}>
                                    {{$siteItem['title']}} - ({{$siteItem['language']}})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Published --}}
                    <div class="col-lg-2 mb-3">
                        <label for="record_state">{{__("admin.system.translations.Published")}}:</label>
                        <div class="input-group">
                            <select name="translation_published" id="translation_published" class="form-select">
                                <option value="">
                                    {{__("admin.system.translations.All")}}
                                </option>
                                <option value="0" {{@$filter->translation_published=="0" ? "selected" : ""}}>
                                    {{__("admin.system.translations.No")}}
                                </option>
                                <option value="1" {{@$filter->translation_published=="1" ? "selected" : ""}}>
                                    {{__("admin.system.translations.Yes")}}
                                </option>
                            </select>
                        </div>
                    </div>

                </div>
                <a onclick="postForm(); return false;" class="btn btn-dark btn-bold">
                    <em class="fas fa-search"></em> {{__("admin.system.translations.Search")}}
                </a>
            </form>
        </div>
    </div>
</div>
