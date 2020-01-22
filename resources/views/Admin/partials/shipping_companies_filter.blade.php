<button class="btn btn-primary waves-effect waves-light float-right m-r-10" data-toggle="collapse" data-target="#filtersRow"><i class="feather icon-search"></i> Filter & Search</button>
<div class="clearfix"></div>
<div id="filtersRow" class="row m-t-20 collapse">
	<div class="col-xs-12">
		<form action="{{route('search.shipping')}}" method="GET">
			<div class="row">
				<div class="col-md-4 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($name)) value="{{$name}}" @else value="" @endif name="name" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Name</label>
					</div>
				</div>
				<div class="col-md-4 form-material">
					<div class="form-group">
						<input type="text" @if(!empty($email)) value="{{$email}}" @else value="" @endif name="email" class="form-control">
						<span class="form-bar"></span>
						<label class="float-label">Email</label>
					</div>
				</div>
				<div class="col-md-4">
					<select name="service" class="form-control">
						<option value="">Select Service</option>
						<option @if(!empty($service)) @if($service == 'pallet') selected @endif @endif value="pallet">Pallet Service</option>
						<option @if(!empty($service)) @if($service == 'container') selected @endif @endif value="container">Container Service</option>
						<option @if(!empty($service)) @if($service == 'truck') selected @endif @endif value="truck">Truck Service</option>
						<option @if(!empty($service)) @if($service == 'parcel') selected @endif @endif value="parcel">Parcel Service</option>
					</select>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select name="from_reg" class="form-control" id="from_reg">
                            <option value="">Shipping From Region</option>
                            @foreach($regions as $region)
                                <option @if(!empty($from_reg)) @if($from_reg == $region->id) selected @endif @endif value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select name="to_reg" class="form-control" id="to_reg">
                            <option value="">Shipping To Region</option>
                            @foreach($regions as $region)
                                <option @if(!empty($to_reg)) @if($to_reg == $region->id) selected @endif @endif value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<select name="from_cou" class="form-control" id="from_cou">
                            <option value="">Shipping From Country</option>
                            @foreach($countries as $country)
                                <option @if(!empty($from_cou)) @if($from_cou == $country->id) selected @endif @endif value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
					</div>
				</div>
				<div class="col-md-3">
					<select name="to_cou" class="form-control" id="to_cou">
						<option value="">Shipping To Country</option>
						@foreach($countries as $country)
							<option @if(!empty($to_cou)) @if($to_cou == $country->id) selected @endif @endif value="{{$country->id}}">{{$country->name}}</option>
						@endforeach
					</select>
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
