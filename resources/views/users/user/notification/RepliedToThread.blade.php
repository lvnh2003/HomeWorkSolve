
    <a href="#paper-kit" class="notification-item" >
        <div class="notification-text 
        @if (!$notification->read_at)
        bg-light  
        @endif
         
         " style="padding: 15px;border-radius: 10px;margin-top: 7px">
            
           <span class="label label-icon label-warning"><i class="fa fa-comments" aria-hidden="true"></i>
           </span>
           
          
          <a class="message" href="{{ route('post.detail.read',[$notification->data['post']['slug'],$notification->id ]) }}" style="color: black">
            
            <b> {{$notification->data['user']['name']}} </b>đã bình luận bài viết của bạn có chủ đề <b> {{$notification->data['post']['caption']}}</b>
            
           
          </a>
           <br>
           <span class="time">{{$notification->created_at->diffForHumans()}}</span>
           
          
        </div>
     </a>
