<?php
// This is where you can include your header, such as 'header.php' if applicable.
include('header.php');
?>

<!-- Customer Inquiry Form Section -->
<section class="p-5 bg-dark text-white">
  <div class="container">
    <h2 class="text-center mb-4">Customer Inquiry Form</h2>
    <form action="submit_inquiry.php" method="POST">
      
      <!-- Name Field -->
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
      </div>
      
      <!-- Email Field -->
      <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email address">
      </div>
      
      <!-- Subject Field -->
      <div class="mb-3">
        <label for="subject" class="form-label">Subject</label>
        <input type="text" class="form-control" id="subject" name="subject" required placeholder="Enter the subject of your inquiry">
      </div>
      
      <!-- Message Field -->
      <div class="mb-3">
        <label for="message" class="form-label">Message</label>
        <textarea class="form-control" id="message" name="message" rows="4" required placeholder="Enter your message"></textarea>
      </div>
      
      <!-- Submit Button -->
      <div class="text-center">
        <button type="submit" class="btn btn-warning">Submit Inquiry</button>
      </div>
      
    </form>
  </div>
</section>

<?php
// This is where you can include your footer, such as 'footer.php' if applicable.
include('footer.php');
?>
