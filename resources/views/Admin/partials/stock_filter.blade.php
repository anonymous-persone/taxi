<button class="btn btn-primary waves-effect waves-light float-right m-r-10" data-toggle="collapse" data-target="#filtersRow"><i class="feather icon-search"></i> Filter & Search</button>
<div class="clearfix"></div>
<div id="filtersRow" class="row m-t-20 collapse">
	<div class="col-xs-12">
		<form action="{{route('search.stocks')}}" method="GET">
			<div class="row">
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($name)) value="{{$name}}" @else value="" @endif name="name" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Username</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($title)) value="{{$title}}" @else value="" @endif name="title" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Title</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($brand)) value="{{$brand}}" @else value="" @endif name="brand" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Brand</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($model)) value="{{$model}}" @else value="" @endif name="model" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Model</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($company)) value="{{$company}}" @else value="" @endif name="company" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Company</label>
					</div>
				</div>
				<div class="col-md-3">
					<select name="category_id" class="form-control" id="categories">
						<option value="">Main Category</option>
						@foreach($categories as $category)
							<option @if(!empty($cat)) @if($cat == $category->id) selected @endif @endif value="{{$category->id}}">{{$category->title}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-3 form-material">
					<select class="form-control" name="sub_category_id">
						<option value="">Sub Category</option>
						@foreach($sub_categories as $cate)
							<option value="{{$cate->id}}" @if(!empty($cat)) @if($cat == $cate->id) selected @endif @endif>{{$cate->title}}</option>
						@endforeach
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
				<div class="col-md-3">
					<select name="condition" class="form-control" id="condition">
						<option value="">Choose Condition</option>
						<option @if(!empty($condition)) @if($condition == 'New') selected @endif @endif value="New">New</option>
						<option @if(!empty($condition)) @if($condition == 'Used') selected @endif @endif value="Used">Used</option>
						<option @if(!empty($condition)) @if($condition == 'Refurbished') selected @endif @endif value="Refurbished">Refurbished</option>
					</select>
				</div>
				<div class="col-md-3 form-material">
					<label>From Date</label>
					<input name="from_date" type="date" class="form-control datetimepicker" id="dateFromFilter" data-format="YYYY-MM-DD" @if(!empty($from_date)) value="{{$from_date}}" @endif>
				</div>
				<div class="col-md-3 form-material">
					<label>To Date</label>
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
