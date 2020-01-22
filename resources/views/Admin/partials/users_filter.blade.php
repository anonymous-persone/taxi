<button class="btn btn-primary waves-effect waves-light float-right m-r-10" data-toggle="collapse" data-target="#filtersRow"><i class="feather icon-search"></i> Filter & Search</button>
<div class="clearfix"></div>
<div id="filtersRow" class="row m-t-20 collapse">
	<div class="col-xs-12">
		<form action="{{route('search.users')}}" method="GET">
			<div class="row">
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" name="name" class="form-control" @if(!empty($name)) value="{{$name}}" @endif>
						<span class="form-bar"></span>
						<label class="float-label">Name</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" name="username" class="form-control" @if(!empty($username)) value="{{$username}}" @endif>
						<span class="form-bar"></span>
						<label class="float-label">Username</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" name="email" class="form-control" @if(!empty($email)) value="{{$email}}" @endif>
						<span class="form-bar"></span>
						<label class="float-label">Email</label>
					</div>
				</div>
				<div class="col-md-3 form-material">
					<div class="form-group">
						<input type="text" name="company" class="form-control" @if(!empty($company)) value="{{$company}}" @endif>
						<span class="form-bar"></span>
						<label class="float-label">Company name</label>
					</div>
				</div>
				<div class="col-md-4">
					<select name="regions" class="form-control" id="regions">
						<option value="">Choose Region</option>
						@foreach($regions as $region)
							<option value="{{$region->id}}" @if(!empty($reg)) @if($reg == $region->id) selected @endif @endif>{{$region->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<select name="countries" class="form-control" id="countries">
						<option value="">Choose Country</option>
						@foreach($countries as $country)
							<option value="{{$country->id}}" @if(!empty($cou)) @if($cou == $country->id) selected @endif @endif>{{$country->name}}</option>
						@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<select name="type_id" class="form-control">
							<option value="">Choose Company Type</option>
							@foreach($types as $type)
							<option @if(!empty($ty)) @if($ty == $type->id) selected @endif @endif value="{{$type->id}}">{{$type->name}}</option>
							@endforeach
						</select>
					</div>
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
