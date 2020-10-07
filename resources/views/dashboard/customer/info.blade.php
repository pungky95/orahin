<div class="kt-user-card-v2">
    <div class="kt-user-card-v2__pic">
        <div class="kt-badge kt-badge--xl kt-badge--{{$color}}">
            <span>{{substr($customer->name,0,1)}}</span></div>
    </div>
    <div class="kt-user-card-v2__details">
        <span class="kt-user-card-v2__name">{{$customer->name}}</span>
        <a href="mailto:{{$customer->email}}"
           class="kt-user-card-v2__email kt-link">{{$customer->email}}</a>
    </div>
</div>
