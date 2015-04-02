@if (!empty($archives))
<!-- Archives Widget Start -->
<div class="widget testimonials">
   <h3 class="title">News Archives</h3>
   <ul>
   @foreach ($archives as $year => $months)
   		<li><strong>{{ $year }}</strong>
	   		<ul>
	   			@foreach ($months as $monthNumber => $month)
	   				<li><a href="/news/{{ $year }}/{{ $monthNumber }}">{{ $month['monthname'] }} ({{ $month['count'] }})</a></li>
	   			@endforeach
	   		</ul>
   		</li>
   @endforeach
   </ul>
</div>
<!-- Archives Widget End -->
@endif