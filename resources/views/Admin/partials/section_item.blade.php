<div class="m-b-20 ui-sortable-handle">
    <div class="card-sub">
        <div class="card-block">
            <h5 class="card-title mb-0" data-toggle="collapse" data-target="#{{'sectionItem'.strtolower($key)}}" aria-expanded="true">
                {{__('Section Item')}}
                <div class="float-right">
                    <a href="#" class="item-remove-btn"><i class="feather icon-trash-2 f-w-600 f-16 text-c-red"></i></a>
                </div>
            </h5>
            <div id="{{'sectionItem'.strtolower($key)}}" class="collapse" data-parent="#itemsWrapper">
                <div class="card-body">
					@foreach($definition->item_fields as $item_field)
                    <div class="form-group form-primary">
                        @if('image' == $item_field->type || 'file' == $item_field->type)
                        <label>{{ $item_field->display_name }}</label>
                        @endif
                        @if('textarea' == $item_field->type)
                        <textarea name="items[{{$item_field->field}}][{{$key}}]" class="form-control @if(!empty($item->{$item_field->field}))fill @endif" @if($item_field->required) required @endif>{{$item->{$item_field->field} or ''}}</textarea>
                        @elseif('select' == $item_field->type)
                        <select name="items[{{$item_field->field}}][{{$key}}]" class="form-control" @if($item_field->required) required @endif>
                            @foreach($item_field->options as $option)
                            <option value="{{$option->value}}" @if(isset($item->{$item_field->field}) && $option->value == $item->{$item_field->field}) selected @endif>{{$option->name}}</option>
                            @endforeach
                        </select>
                        @elseif('image' == $item_field->type)
                        <div class="row">
							<div class="col-md-2">
								@if(!empty($item->{$item_field->field}))
								<img src="{{@asset('storage/' . $item->{$item_field->field})}}" class="img-thumbnail">
								<input type="hidden" name="items[{{$item_field->field}}][{{$key}}]" value="{{ $item->{$item_field->field} }}">
								@endif
							</div>
                            <div class="col-md-10">
                                <input type="file" class="form-control" accept="image/*" name="items[{{$item_field->field}}][{{$key}}]" @if((!isset($item->{$item_field->field}) || empty($item->{$item_field->field})) && $item_field->required) required @endif>
                            </div>
                        </div>
                        @else
                        <input type="{{$item_field->type}}" class="form-control @if(!empty($item->{$item_field->field}))fill @endif" name="items[{{$item_field->field}}][{{$key}}]" value="{{$item->{$item_field->field} or ''}}" @if($item_field->required) required @endif>
                        @endif
                        <span class="form-bar"></span>
                        @if('image' != $item_field->type && 'file' != $item_field->type)
                        <label class="float-label">{{ $item_field->display_name }}</label>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
