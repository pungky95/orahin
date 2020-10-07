<div class="kt-user-card-v2">
    <div class="kt-user-card-v2__pic">
        <div class="kt-badge kt-badge--xl kt-badge--{{$color}}">
            <span>{{substr($order->customer->name,0,1)}}</span></div>
    </div>
    <div class="kt-user-card-v2__details">
        <span class="kt-user-card-v2__name">{{$order->customer->name}}</span>
        <a href="mailto:{{$order->customer->email}}"
           class="kt-user-card-v2__email kt-link">{{$order->customer->email}}</a>
    </div>
</div>
