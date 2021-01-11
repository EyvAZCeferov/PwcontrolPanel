@section('title')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            Add Post
        @else
            @if($post)
                {{$post[0]->az_name}}   Edit Post
            @endif
        @endif
    @else
        Add Post
    @endif
@endsection
@section('pageName')
    @if($urlPath)
        @if (str_contains($urlPath,'add'))
            Add Post
        @else
            @if($post)
                {{$post[0]->az_name}}   Edit Post
            @endif
        @endif
    @else
        Add Post
    @endif
@endsection
@section('js')
    @parent
    <!--tinymce js-->
    <script src="{{asset('/assets/admin/cssjslib/libs/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('/assets/admin/cssjslib/js/pages/form-editor.init.js')}}"></script>
@endsection
<div>
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    @if (session()->has('message'))
                        <div class="alert alert-warning" role="alert">
                            <strong>{{session('message')}}</strong>
                        </div>
                    @endif

                    <div wire:loading>
                        <div class="alert alert-info" role="alert">
                            <strong>Əməliyyat icra edilir...</strong>
                        </div>
                    </div>
                </div>

                @if (str_contains($urlPath,'edit'))
                    <div class="w-100"
                         style="scroll-behavior: auto; overflow-scrolling: touch; overflow-y: hidden; overflow-x: scroll;">
                        @foreach(json_decode($post[0]->images) as $image)
                            <div class="d-inline-block w-25 position-relative">
                                <img
                                    src="{{asset('/storage/uploads/posts/'.$post[0]->clasor.'/'.$image)}}"
                                    class="img-fluid img-thumbnail border border-primary w-100 position-relative"
                                    alt="{{$image}}"/>
                                <button
                                    title="Şəkili Sil!"
                                    wire:click="deleteImage('{{$image}}')"
                                    data-title="Şəkili Sil"
                                    class="btn btn-danger position-absolute top-0 right-0 "
                                    style="position: absolute;top:0;right: 0; z-index: 20"
                                >
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

                <form class="custom-validation mt-1"
                      @if (str_contains($urlPath,'edit')) wire:submit.prevent="update"
                      @else wire:submit.prevent="save" @endif>
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            @if ( str_contains($urlPath,'edit') )
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Şəkli Dəyişdirmək üçün seçin</label>
                                            <input
                                                accept="image/*"
                                                wire:model="formFields.images"
                                                type="file"
                                                multiple
                                            />
                                        </div>
                                        @error('formFields.images') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @else
                                <div class="card">
                                    <div class="card-body">

                                        <div class="form-group">
                                            <label>Şəkli seç</label>
                                            <input
                                                accept="image/*"
                                                wire:model="formFields.images"
                                                type="file"
                                                required
                                                multiple
                                            />
                                        </div>
                                        @error('formFields.images') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Ad</h4>
                                    <p class="card-title-desc">Maksimum 300 simvoldan ibarət olmalıdır</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.az_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$post[0]->az_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.az_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Name</h4>
                                    <p class="card-title-desc">Maksimum 300 simvoldan ibarət olmalıdır</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.en_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$post[0]->en_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.en_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">имя</h4>
                                    <p class="card-title-desc">Maksimum 300 simvoldan ibarət olmalıdır</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.ru_name"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$post[0]->ru_name}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.ru_name') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-3">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Slug / Url</h4>
                                    <p class="card-title-desc">Maksimum 300 simvoldan ibarət olmalıdır</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.slug"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$post[0]->slug}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                           value="{{$formFields['slug']}}"
                                        @endif
                                    />
                                    @error('formFields.slug') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body w-100 d-flex">
                                    <div class="w-100 d-inline-block">
                                        <h4 class="card-title">Müştəri </h4>
                                        <p class="card-title-desc">Aşağda qeyd olunmuş sahədən Müştərini seçin və
                                            ya
                                            redaktə
                                            edin.</p>
                                        <select class="form-control" wire:model="formFields.customer_id">
                                            @if(str_contains($urlPath,'edit'))
                                                @foreach($customers as $id_customer)
                                                    <option
                                                        value="{{$id_customer['id']}}"
                                                        @if($id_customer['id'] === $post[0]->customer_id)
                                                        selected
                                                        value="{{$post[0]->customer_id}}"
                                                        @endif
                                                    >
                                                        {{$id_customer['az_name']}}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option selected value="">Müştərini seç</option>
                                                @foreach($customers as $id_category)
                                                    <option value="{{$id_category['id']}}">
                                                        {{$id_category['az_name']}}
                                                    </option>
                                                @endforeach
                                            @endif

                                        </select>
                                        @error('formFields.customer_id') <span
                                            class="error">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Açıqlama</h4>
                                    <p class="card-title-desc">Maksimum 1000 simvoldan ibarət olmalıdır</p>

                                    <textarea

                                    rows="5"
                                    class="form-control"
                                    wire:model="formFields.az_description"
                                    name="az_description"  ></textarea>

                                    @error('formFields.az_description') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Description</h4>
                                    <p class="card-title-desc">Maksimum 1000 simvoldan ibarət olmalıdır</p>

                                    <textarea
                                    rows="5"
                                    class="form-control"
                                    wire:model="formFields.en_description"
                                              name="en_description"></textarea>

                                    @error('formFields.en_description') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Описание</h4>
                                    <p class="card-title-desc">Maksimum 1000 simvoldan ibarət olmalıdır</p>

                                    <textarea
                                    rows="5"
                                    class="form-control"
                                    wire:model="formFields.ru_description"
                                              name="ru_description"></textarea>

                                    @error('formFields.ru_description') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Başlanğıc - Son tarix</h4>
                                    <p class="card-title-desc">Maksimum 1000 simvoldan ibarət olmalıdır</p>


                                    <div class="w-100 d-block">
                                        <div class="w-100 d-block">
                                            <input class="form-control w-100 d-inline-block" type="datetime-local"
                                                   wire:model="formFields.startTime"
                                                   value="{{\Carbon\Carbon::now()}}"
                                                   id="example-datetime-local-input"/>
                                        </div>
                                        <div class="w-100 d-block">
                                            <input class="form-control w-100 d-inline-block" type="datetime-local"
                                                   wire:model="formFields.endTime"
                                                   value="{{\Carbon\Carbon::now()}}"
                                                   id="example-datetime-local-input"/>
                                        </div>
                                    </div>

                                    @error('formFields.startTime') <span
                                        class="error">{{ $message }}</span> @enderror
                                    @error('formFields.endTime') <span
                                        class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Qiymət</h4>
                                    <p class="card-title-desc">Maksimum 50 simvoldan ibarət olmalıdır</p>

                                    <input type="text" class="form-control" maxlength="300"
                                           wire:model.debounce.500ms="formFields.price"
                                           @if (str_contains($urlPath,'edit'))
                                           value="{{$post[0]->price}}"
                                           @else
                                           name="defaultconfig"
                                           id="defaultconfig"
                                        @endif
                                    />
                                    @error('formFields.price') <span class="error">{{ $message }}</span> @enderror

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6 justify-center align-center text-center ">
                            <button type="submit"
                                    class="justify-center mx-auto align-center text-center btn-lg btn btn-outline-primary"
                                    data-toggle="tooltip"
                                    data-placement="top"
                                    @if(str_contains($urlPath,'add'))
                                    title="Əlavə et"
                                    data-title="Əlavə et"
                                    @else
                                    title="Düzəliş et"
                                    data-title="Düzəliş et"
                                @endif
                            >
                                @if(str_contains($urlPath,'add'))
                                    <i class="mdi mdi-content-save font-size-24"></i>
                                @else
                                    <i class="mdi mdi-lead-pencil font-size-24"></i>
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

