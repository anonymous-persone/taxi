<button class="btn btn-primary waves-effect waves-light float-right m-r-10" data-toggle="collapse" data-target="#filtersRow"><i class="feather icon-search"></i> Filter & Search</button>
<div class="clearfix"></div>
<div id="filtersRow" class="row m-t-20 collapse">
	<div class="col-xs-12">
		<form action="{{route('search.companies')}}" method="GET">
			<div class="row">
				<div class="col-md-4 form-material">
					<div class="form-group">
						<input type="text" name="name" class="form-control" @if(!empty($name)) value="{{$name}}" @endif>
						<span class="form-bar"></span>
						<label class="float-label">Name</label>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<select name="membership" class="form-control" id="regions">
							<option value="">Choose Membership Type</option>
							@foreach($memberships as $membership)
								<option value="{{$membership->id}}" @if(!empty($member)) @if($member == $membership->id) selected @endif @endif>{{$membership->title}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<select name="regions" class="form-control" id="regions">
							<option value="">Choose Region</option>
							@foreach($regions as $region)
								<option value="{{$region->id}}" @if(!empty($reg)) @if($reg == $region->id) selected @endif @endif>{{$region->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<select name="countries" class="form-control" id="countries">
							<option value="">Choose Country</option>
							@foreach($countries as $country)
								<option value="{{$country->id}}" @if(!empty($cou)) @if($cou == $country->id) selected @endif @endif>{{$country->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<select name="status" class="form-control" id="statuse">
							<option value="">Choose Status</option>
							<option @if(!empty($stat)) @if($stat == 'active') selected @endif @endif value="active">Active</option>
							<option @if(!empty($stat)) @if($stat == 'verified') selected @endif @endif value="verified">Pending payment</option>
							<option @if(!empty($stat)) @if($stat == 'suspended') selected @endif @endif value="suspended">Suspended</option>
						</select>
					</div>
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
							<input type="hidden" name="section" value="{{$page}}">
							<button type="submit" class="btn btn-block btn-primary">Filter</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
