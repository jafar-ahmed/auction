 <style>
     /* body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}
*/
     /* *:before, *:after {
  box-sizing: inherit;
} */

     .row1 {
         margin-left: 85px;
     }

     .column1 {
         float: left;
         width: 30%;
         margin-bottom: 100px;
         padding: 0 5px;
     }

     .card1 {
         box-shadow: 0 0px 8px 0 rgba(0, 0, 0, 0.2);
         margin: 5px;
          background-color: white;
     }

     .about-section1 {
         padding: 100px;
         text-align: center;
         /* background-color: #bac0cf; */
         color: white;
         margin-bottom: 100px;
         height: 200px;


     }

     .container1 {
         padding: 0 16px;

     }

     .container1::after,
     .row1::after {
         content: "";
         clear: both;
         display: table;
     }

     .title1 {
         color: grey;
         margin-bottom: 50px;
     }

     .button1 {
         border: none;
         outline: 0;
         display: inline-block;
         padding: 8px;
         color: rgb(3, 3, 3);
         text-align: center;
         cursor: pointer;
         width: 100px;
         border: 1px;
     }

     .button1:hover {
         background-color: black;
         color: white;
     }

     @media screen and (max-width: 650px) {
         .column1 {
             width: 100%;
             display: block;
         }
     }

     .h {
         margin-bottom: 50px;
        
     }

     .about-section1 {
         margin-top: 50px;

     }
 </style>

 <div class="about-section1">
     <h1 style="color: rgb(0, 0, 0); font-weight: bold;">Overview</h1>
     <p style="color: rgb(0, 0, 0);">In particular, The need and the lack of availability for a platform where a
         person or an organization can sell products in the best price via auction and<br><br> Lack of knowledge of the
         non-expert person the actual price of the offered product</p>
     <p style="color: rgb(0, 0, 0);">According to earlier studies, there are more than 70% sellers looking for an
         auction to sell their products and buyers want a reliable and affordable auction
     </p>
 </div>
 {{-- <section class="lots">
 <ul class="lots__list">
            @foreach ($lots as $lot)
            @include('lot.mini')
        @endforeach
        </ul>
 </section> --}}
 <h2 class="h" style="text-align:center; color: rgb(0, 0, 0);">Our Team</h2>
 <div class="row1">
     <div class="column1">
         <div class="card1">
             <img src="/storage/avatar/khalil1.png" alt="Jane" style="width:50%">
             <div class="container1">
                 <h2>Khalil Bashir AlSori</h2>
                 <p class="title1">Designer</p>
                 <p>ID: 120181518</p>
                 <p><a href="https://mail.google.com/">kalsori@students.iugaza.edu.ps</a> </p>
                 <p><button class="button1">Contact</button></p>
             </div>
         </div>
     </div>

     <div class="column1">
         <div class="card1">
             <img src="/storage/avatar/logo.png" alt="Mike" style="width:50%">
             <div class="container1">
                 <h2>Jafar Ahmed Aboras</h2>
                 <p class="title1">CEO & Developer</p>
                 <p>ID: 120180455</p>
                 <p><a href="https://mail.google.com/">jaburas@students.iugaza.edu.ps</a> </p>
                 <p><button class="button1">Contact</button></p>
             </div>
         </div>
     </div>

     <div class="column1">
         <div class="card1">
             <img src="/storage/avatar/ismail1.png" alt="John" style="width:50%">
             <div class="container1">
                 <h2>Ismail Raed Isleem</h2>
                 <p class="title1">Developer</p>
                 <p>ID: 120180800</p>
                 <p><a href="https://mail.google.com/">iesleem@students.iugaza.edu.ps</a> </p>
                 <p><button class="button1">Contact</button></p>
             </div>
         </div>
     </div>
 </div>
