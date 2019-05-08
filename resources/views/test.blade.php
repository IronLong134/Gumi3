<?php

   foreach ($datas as $data)
       {
           if($data->sender->id==$user->id)
               {
                   foreach ($data->receive->post as $post)
                   {
                       echo $post->id;
                       echo $data->receive->name."<br>";
                       echo $post->content."<br>";
                   }
               }
          else if($data->receive->id==$user->id)
              {
                  foreach ($data->sender->post as $post)
                  {
                      echo $post->id;
                      echo $data->sender->name."<br>";
                      echo $post->content."<br>";
                  }
              }
       }


?>


