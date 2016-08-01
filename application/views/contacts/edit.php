<div class="container-fluid">
    <div class="panel-body">
        <form action="<?php echo site_url('contacts/' . $contact->id.'/update') ?>" method="POST" role="form">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="First name"
                       value="<?php echo $contact->first_name ?>">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last name"
                       value="<?php echo $contact->last_name ?>">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email"
                       value="<?php echo $contact->email ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Phone"
                       value="<?php echo $contact->phone ?>">
            </div>
            <div class="form-group">
                <label for="notes">Notes</label>
                    <textarea class="form-control" name="notes" id="notes" placeholder="" rows="5"
                    ><?php echo $contact->notes ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="<?php echo site_url('contacts/' . $contact->id) ?>" role="button" class="btn btn-default">Cancel</a>
        </form>
    </div>
</div>