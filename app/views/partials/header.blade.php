<!-- Main Header Start -->
<div class="main-header">
   <div class="container">
	   <!--
    	<div class="topnav navbar-header">
	    	<a class="navbar-toggle down-button" data-toggle="collapse" data-target=".slidedown">
				<i class="icon-angle-down icon-current"></i>
			</a> 
	  </div>
	  -->
      <!-- Logo Start -->
      <div class="logo pull-left">
         <h1>
            <a href="/">
            <img class="canaport-logo" src="/img/canaport_logo.jpg" alt="Canaport LNG">
            </a>
         </h1>
      </div>
      <!-- Logo End -->
      <!-- Mobile Menu Start -->
      <div class="mobile navbar-header">
         <a class="navbar-toggle" data-toggle="collapse" href=".navbar-collapse">
         <i class="icon-reorder icon-2x"></i>
         </a> 
      </div>
      <!-- Mobile Menu End -->

      <!-- Menu Start -->
      <nav class="collapse navbar-collapse menu">
         <ul class="nav navbar-nav sf-menu">
         	@if((Auth::check()) && (Auth::user()->access_level == 3) && (Auth::user()->roles->contains(3)))

				@foreach((MenuItem::where('menu_id','=','1')->orderBy('sort_order')->remember(525949)->get()) as $item)
					@if ($item->has_children == 0)
						@if ($item->active == 1)
							@if ($item->page_id == 0)
								<li>
									<a class='mitem' data-mitem-id="{{ $item->id }}" href='{{ $item->url }}'>{{ $item->menu_text }}</a>
								</li>
							@else
								<li>
									<a class='mitem' data-mitem-id="{{ $item->id }}" 
										href='/{{ $item->targetPage->slug }}'>{{ $item->menu_text }}</a>
								</li>
								@endif
						@else
							@if ($item->page_id == 0)
								<li>
									<a class='mitem' data-mitem-id="{{ $item->id }}" 
										href='{{ $item->url }}'><em class='text-warning'>{{ $item->menu_text }}</em></a>
								</li>
							@else
								<li>
									<a class='mitem' data-mitem-id="{{ $item->id }}" 
										href='/{{ $item->targetPage->slug }}'><em class='text-warning'>{{ $item->menu_text }}</em></a>
								</li>
							@endif
						@endif
					@else
						@if ($item->active == 1)
							<li>
								<a class='mitem' data-mitem-id="{{ $item->id }}" 
									href="javascript:void(0)">{{ $item->menu_text }}</a>
						@else
							<li>
								<a class='mitem' data-mitem-id="{{ $item->id }}" 
									href="javascript:void(0)"><em class='text-warning'>{{ $item->menu_text }}</em>
								</a>
						@endif
						<ul>
							@foreach ($item->dropdownItems as $dd)
								@if ($dd->active == 1)
									@if ($dd->page_id == 0)
										<li><a class='ddmitem sf-with-ul' data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}" 
											href="{{ $dd->url }}">{{ $dd->menu_text }}</a></li>
									@else
										<li><a class='ddmitem sf-with-ul' data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}"
											href="/{{ $dd->targetPage->slug }}">{{ $dd->menu_text }}</a></li>
									@endif
								@else
									@if ($dd->page_id == 0)
										<li><a class="ddmitem sf-with-ul" data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}"
											href="{{ $dd->url }}"><em class='text-warning'>{{ $dd->menu_text }}</em></a></li>
									@else
										<li><a class="ddmitem sf-with-ul" data-ddmitem-id="{{ $dd->id }}" data-mitem-id="{{ $item->id }}"
											href="/{{ $dd->targetPage->slug }}"><em class='text-warning'>{{ $dd->menu_text }}</em></a></li>
									@endif
								@endif
							@endforeach
							<li><a href="javascript:void(0)" onclick="addDDMenuItem({{ $item->id }})">[Add item]</a></li>
						</ul>
					@endif
				@endforeach
			@else
				@foreach((MenuItem::where('menu_id','=','1')->where('active','=','1')->orderBy('sort_order')->remember(525949)->get()) as $item)
					@if ($item->has_children == 0)
						@if ($item->page_id == 0)
							<li><a href='{{ $item->url }}'>{{ $item->menu_text }}</a></li>
						@else
							<li><a href="/{{ $item->targetPage->slug }}">{{ $item->menu_text }}</a></li>
						@endif
					@else
						<li>
							<a class='mitem' href="javascript:void(0)">{{ $item->menu_text }}</a>
							<ul>
								@foreach ($item->dropdownItems as $dd)
									@if ($dd->active == 1)
										@if ($dd->page_id == 0)
											<li><a href="{{ $dd->url }}">{{ $dd->menu_text }}</a></li>
										@else
											<li><a href="/{{ $dd->targetPage->slug }}">{{ $dd->menu_text }}</a></li>
										@endif
									@endif
								@endforeach
							</ul>
					@endif
				@endforeach
			@endif
			
			@if(Auth::check())
				@if(Auth::user()->access_level == 3)
					@if (Auth::user()->roles->contains(3))
						<li><a href="javascript:void(0)" onclick="addMenuItem()">[ + ]</a></li>
					@endif
					
					@if ((Auth::user()->roles->contains(1)) || (Auth::user()->roles->contains(2)))
						<li>
							<a class='mitem' href="javascript:void(0)">Admin</a>
							
					@endif
					<ul>
						<li><a href="/users/dashboard">Dashboard</a></li>
						@if (Auth::user()->roles->contains(1))
							<li><a class='menu-item' href="javascript:void(0)" onclick="makePageEditable(this)">Edit content</a></li>
							 <li><a class='' href="/admin/allpages">Manage pages</a></li>
						@endif
						@if (Auth::user()->roles->contains(2))
							<li><a class='' href="/admin/addnews" >Add news item</a></li>
						@endif
						<li><a class='' href="/admin/allgalleryimages">Manage gallery</a></li>
						<li><a class='' href="/calendar/addevent">Add Calendar event</a></li>
						<li><a class='' href="/calendar/allevents">Manage Calendar events</a></li>
						<li><a href="/admin/addnewsletter">Add Connections newsletter</a></li>
						<li><a href="/admin/addminutes">Add CCELC minutes</a></li>
						<li><a href="/admin/allinvolvement">Manage Community Involvement</a></li>
						<li><a href="/admin/splash">Manage Splash Text/Image</a></li>
						<li><a href="/users/logout">Logout</a></li>
					</ul>
				</li>
				@endif
			@endif
         </ul>
      </nav>
      <!-- Menu End --> 
   </div>

</div>
</header>
<!-- Main Header End -->