<aside class="widget" style="font-size: 12pt">
	<br><br>
	<dl class="dl-horizontal">
		<dt>User</dt>
		<dd>
			<a href="/users/dashboard">
			@if (Request::path() == "users/dashboard")
				<strong>
			@endif
				Dashboard
			@if (Request::path() == "users/dashboard")
				</strong>
			@endif
			</a>
		</dd>
		<dd>
			<a href="/users/account">
			@if (Request::path() == "users/account")
				<strong>
			@endif
				Your Account
			@if (Request::path() == "users/account")
				</strong>
			@endif
			</a>
		</dd>
		<dd>
			<a href="/users/password">
			@if (Request::path() == "users/password")
				<strong>
			@endif
				Change Password
			@if (Request::path() == "users/password")
				</strong>
			@endif
			</a>
		</dd>
		<dd>
			<a href="/users/security">
			@if (Request::path() == "users/security")
				<strong>
			@endif
				Security
			@if (Request::path() == "users/security")
				</strong>
			@endif
			</a>
		</dd>
		<dd>&nbsp;</dd>

	
@if((Auth::check()) && (Auth::user()->access_level == 3))

			@if (Auth::user()->roles->contains(1))
				<dt>Pages</dt>
				<dd>
					<a href="/admin/createpage">
					@if (Request::path() == "admin/createpage")
						<strong>
					@endif
						Add a page
					@if (Request::path() == "admin/createpage")
						</strong>
					@endif
					</a>
				</dd>
				
				<dd>
					<a href="/admin/allpages">
					@if (Request::path() == "admin/allpages")
						<strong>
					@endif
						Manage pages
					@if (Request::path() == "admin/allpages")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
				
				<dt>Community</dt>
				<dd>
					<a href="/admin/addinvolvement">
					@if (Request::path() == "admin/addinvolvement")
						<strong>
					@endif
						Add Community Involvement Item
					@if (Request::path() == "admin/addinvolvement")
						</strong>
					@endif
					</a>
				</dd>
				<dd>
					<a href="/admin/allinvolvement">
					@if (Request::path() == "admin/allinvolvement")
						<strong>
					@endif
						Manage Community Involvement Items
					@if (Request::path() == "admin/allinvolvement")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(6))
				<dt>Gallery</dt>
				<dd>
					<a href="/admin/galleryupload">
					@if (Request::path() == "admin/galleryupload")
						<strong>
					@endif
						Add Gallery Image
					@if (Request::path() == "admin/galleryupload")
						</strong>
					@endif
					</a>
				</dd>
				<dd>
					<a href="/admin/allgalleryimages">
					@if (Request::path() == "admin/allgalleryimages")
						<strong>
					@endif
						Manage Gallery
					@if (Request::path() == "admin/allgalleryimages")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(7))
				<dt>Events</dt>
				<dd>
					<a href="/calendar/addevent">
					@if (Request::path() == "calendar/addevent")
						<strong>
					@endif
						Add Calendar Event
					@if (Request::path() == "calendar/addevent")
						</strong>
					@endif
					</a>
				</dd>
				<dd>
					<a href="/calendar/allevents">
					@if (Request::path() == "calendar/allevents")
						<strong>
					@endif
						Manage Calendar Events
					@if (Request::path() == "calendar/allevents")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(5))
				<dt>FAQs</dt>
				<dd>
					<a href="/admin/addfaq">
					@if (Request::path() == "admin/addfaq")
						<strong>
					@endif
						Add FAQ
					@if (Request::path() == "admin/addfaq")
						</strong>
					@endif
					</a>
				</dd>
				<dd>
					<a href="/admin/allfaqs">
					@if (Request::path() == "admin/allfaqs")
						<strong>
					@endif
						Manage FAQ Entries
					@if (Request::path() == "admin/allfaqs")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(10))
				<dt>Misconceptions</dt>
				<dd>
					<a href="/admin/addmisconception">
					@if (Request::path() == "admin/addmisconception")
						<strong>
					@endif
						Add Misconception
					@if (Request::path() == "admin/addmisconception")
						</strong>
					@endif
					</a>
				</dd>
				<dd>
					<a href="/admin/allmisconceptions">
					@if (Request::path() == "admin/allmisconceptions")
						<strong>
					@endif
						Manage Misconceptions
					@if (Request::path() == "admin/allmisconceptions")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			
			@if (Auth::user()->roles->contains(2))
				<dt>News</dt>
				<dd>
					<a href="/admin/addnews">
					@if (Request::path() == "admin/addnews")
						<strong>
					@endif
						Add News Item
					@if (Request::path() == "admin/addnews")
						</strong>
					@endif
					</a>
				</dd>
				
				<dd>
					<a href="/admin/allnews">
					@if (Request::path() == "admin/allnews")
						<strong>
					@endif
						All News Items
					@if (Request::path() == "admin/allnews")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(4))
				<dt>Users</dt>
				<dd>
					<a href="/admin/allusers">
					@if (Request::path() == "admin/allusers")
						<strong>
					@endif
						Manage Users
					@if (Request::path() == "admin/allusers")
						</strong>
					@endif
					</a>
				</dd>
				
				<dd>
					<a href="/admin/adminusers">
					@if (Request::path() == "admin/adminusers")
						<strong>
					@endif
						Manage Admin Users
					@if (Request::path() == "admin/adminusers")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(9))
				<dt>Newsletters</dt>
				<dd>
					<a href="/admin/addnewsletter">
					@if (Request::path() == "admin/addnewsletter")
						<strong>
					@endif
						Add Newsletter
					@if (Request::path() == "admin/addnewsletter")
						</strong>
					@endif
					</a>
				</dd>
				
				<dd>
					<a href="/admin/allnewsletters">
					@if (Request::path() == "admin/allnewsletters")
						<strong>
					@endif
						Manage Newsletters
					@if (Request::path() == "admin/allnewsletters")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif
			
			@if (Auth::user()->roles->contains(8))
				<dt>Minutes</dt>
				<dd>
					<a href="/admin/addminutes">
					@if (Request::path() == "admin/addminutes")
						<strong>
					@endif
						Add CCELC Minutes
					@if (Request::path() == "admin/addminutes")
						</strong>
					@endif
					</a>
				</dd>
				
				<dd>
					<a href="/admin/allminutes">
					@if (Request::path() == "admin/allminutes")
						<strong>
					@endif
						Manage Minutes
					@if (Request::path() == "admin/allminutes")
						</strong>
					@endif
					</a>
				</dd>
				<dd>&nbsp;</dd>
			@endif

@endif

		</dl>
	</aside>