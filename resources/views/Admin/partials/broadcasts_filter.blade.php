<button class="btn btn-primary waves-effect waves-light float-right m-r-10" data-toggle="collapse" data-target="#filtersRow"><i class="feather icon-search"></i> Filter & Search</button>
<div class="clearfix"></div>
<div id="filtersRow" class="row m-t-20 collapse">
	<div class="col-xs-12">
		<form action="{{route('search.broadcast')}}" method="GET">
			<div class="row">
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" name="username" class="form-control" @if(!empty($name)) value="{{$name}}"@endif>
						<span class="form-bar"></span>
						<label class="float-label">Username</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" class="form-control" name="brand" @if(!empty($brand)) value="{{$brand}}" @endif>
						<span class="form-bar"></span>
						<label class="float-label">Brand</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" class="form-control" name="model" @if(!empty($model)) value="{{$model}}"  @endif>
						<span class="form-bar"></span>
						<label class="float-label">Model</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<select class="form-control" name="category_id">
						<option value="">Main Category</option>
						@foreach($categories as $category)
							<option value="{{$category->id}}" @if(!empty($cat)) @if($cat == $category->id) selected @endif @endif>{{$category->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3 form-material">
					<select class="form-control" name="sub_category_id">
						<option value="">Sub Category</option>
						@foreach($sub_categories as $cate)
							<option value="{{$cate->id}}" @if(!empty($sub_cat)) @if($sub_cat == $cate->id) selected @endif @endif>{{$cate->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3">
					<select name="type_id" class="form-control">
						<option value="">Choose Type</option>
						<option value="1" @if(!empty($ty)) @if($ty == 1) selected @endif @endif>Want to sell</option>
						<option value="2" @if(!empty($ty)) @if($ty == 2) selected @endif @endif>Want to Buy</option>
					</select>
				</div>
				<div class="col-md-3">
					<select name="condition" class="form-control">
						<option value="">Choose Condition</option>
						<option value="1" @if(!empty($condition)) @if($condition == 1) selected @endif @endif>New</option>
						<option value="2" @if(!empty($condition)) @if($condition == 2) selected @endif @endif>Used</option>
						<option value="3" @if(!empty($condition)) @if($condition == 3) selected @endif @endif>Refurbished</option>
					</select>
				</div>
				<div class="col-md-3 form-material">
					<select class="form-control" name="region_id">
						<option value="">Choose Region</option>
						@foreach($regions as $reg)
							<option value="{{$reg->id}}" @if(!empty($region)) @if($region == $reg->id) selected @endif @endif>{{$reg->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3 form-material">
					<select class="form-control" name="country_id">
						<option value="">Choose Country</option>
						@foreach($countries as $country)
							<option value="{{$country->id}}" @if(!empty($coun)) @if($coun == $country->id) selected @endif @endif>{{$country->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3 form-material">
					<input name="from_date" type="date" class="form-control datetimepicker" id="dateFromFilter" data-format="YYYY-MM-DD" @if(!empty($from_date)) value="{{$from_date}}" @endif>
				</div>
				<div class="col-md-3 form-material">
					<input name="to_date" type="date" class="form-control datetimepicker" id="dateToFilter" data-format="YYYY-MM-DD" @if(!empty($to_date)) value="{{$to_date}}" @endif>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 offset-md-8">
					<div class="row">
						<div class="col-md-6">
							<a href="{{@url()->current()}}" class="btn btn-block btn-danger">Clear</a>
						</div>
						<div class="col-md-6">
							<button type="submit" class="btn btn-block btn-primary">Filter</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
