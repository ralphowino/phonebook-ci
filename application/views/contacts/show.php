<div class="container-fluid">
    <div class="panel">
        <div class="panel-heading">
            <a href="<?php echo site_url('contacts') ?>" class="btn btn-link"><i class="glyphicon glyphicon-arrow-left"></i> Back to Contacts</a>
        </div>
        <div class="panel-body text-center">
            <img src="<?php echo $contact->profile_image ?>?s=240" class="img-circle">
            <h4><?php echo $contact->name ?></h4>
            <ul class="list-group text-left">
                <li class="list-group-item">
                    <a href="mailto:<?php echo $contact->email ?>" title="Send an email">
                        <i class="glyphicon glyphicon-envelope"></i> <?php echo $contact->email ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="tel:<?php echo $contact->phone ?>" title="Call now">
                        <i class="glyphicon glyphicon-earphone"></i> <?php echo $contact->phone ?>
                    </a>
                </li>
                <li class="list-group-item">
                    <strong class="list-group-item-heading">Notes:</strong>
                    <p><?php echo $contact->notes ?></p>
                </li>
                <li class="list-group-item">
                    <strong class="list-group-item-heading">Created At:</strong>
                    <p><?php echo $contact->created_at ?></p>
                </li>
                <li class="list-group-item">
                    <strong class="list-group-item-heading">Updated At:</strong>
                    <p><?php echo $contact->updated_at ?></p>
                </li>
            </ul>

            <p>
                <a href="mailto:<?php echo $contact->email ?>" class="btn btn-success btn-lg" role="button">
                    <i class="glyphicon glyphicon-envelope"></i>
                </a>
                <a href="tel:<?php echo $contact->phone ?>" class="btn btn-success btn-lg" role="button">
                    <i class="glyphicon glyphicon-earphone"></i>
                </a>
                <a href="sms:<?php echo $contact->phone ?>" class="btn btn-success btn-lg" role="button">
                    <i class="glyphicon glyphicon-comment"></i>
                </a>
            </p>


            <p>
                <a id="edit-contact" href="<?php echo site_url('contacts/'.$contact->id.'/edit') ?>" class="btn btn-default" role="button">
                    <i class="glyphicon glyphicon-pencil"></i>
                </a>
                <button id="delete-btn" class="btn btn-danger" type="button" data-toggle="modal" data-target="#deleteContact">
                    <i class="glyphicon glyphicon-trash"></i>
                </button>
            </p>
        </div>

    </div>

    <div class="modal fade" id="deleteContact" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="<?php echo site_url('contacts/'.$contact->id.'/destroy') ?>" method="POST">
                    <?php echo csrf_field() ?>
                    <?php echo method_field('DELETE') ?>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                        <h4 class="modal-title">Confirm Delete</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete <?php echo $contact->name ?> from your phonebook?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
