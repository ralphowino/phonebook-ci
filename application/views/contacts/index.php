<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <p class="text-center">
                <a href="<?php echo site_url('contacts/create') ?>" class="btn btn-success btn-lg btn-block">
                    Add Contact
                </a>
            </p>

            <form action="<?php echo site_url('contacts') ?>" method="GET" role="form" class="form-inline">
                <p class="input-group">
                    <input type="text" class="form-control" placeholder="Search for..." name="search" value="<?php echo $search ?>">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Find!</button>
                        </span>
                </p><!-- /input-group -->
            </form>
            <div class="list-group">
                <?php if (!empty($contacts['data'])): ?>
                    <?php foreach ($contacts['data'] as $contact): ?>
                        <a href="<?php echo site_url('contacts/' . $contact->id) ?>" class="list-group-item" style="padding: 0;">
                        <span class="row">
                            <span class="col-xs-3">
                                <img src="<?php echo $contact->profile_image ?>?s=32" class="img-responsive">
                            </span>
                            <span class="col-xs-9">
                                <h4><?php echo $contact->name ?></h4>
                            </span>
                        </span>
                        </a>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="alert alert-info">
                        <p>No contacts added yet!</p>
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <div class="pull-left" style="margin:24px 0;">
                    <p><?php echo $contacts['meta']['count'] ?> / <?php echo $contacts['meta']['total'] ?> Contacts</p>
                </div>
                <div class="pull-right">
                    <?php echo $contacts['meta']['links']; ?>
                </div>
            </div>
        </div>
    </div>
</div>
