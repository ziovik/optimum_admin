<div class="container1">  
  <form id="contact" action="email_send.php" method="post">
    <h3>Email Your Customer</h3>
    
    <fieldset width="300px">
      <input placeholder="Your name" type="text" name="name" tabindex="1" required autofocus >
    </fieldset>
    <fieldset>
      <input placeholder="Your Email Address" type="email" name="email" tabindex="2" required>
    </fieldset>
    <fieldset>
      <input placeholder="Your Phone Number (optional)" type="tel" name="tel" tabindex="3" required>
    </fieldset>
    
    <fieldset>
      <textarea placeholder="Type your message here...." tabindex="5" name="comment" required></textarea>
    </fieldset>
    <fieldset>
      <button name="submit" type="submit" name="submit" id="contact-submit" data-submit="...Sending">Submit</button>
    </fieldset>
   
  </form>
</div>