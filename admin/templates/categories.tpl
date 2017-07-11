<!-- Categories management -->
<div class="row">
    <div class="col-md-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Add new category<small>Set background, name and brief description</small></h2>
                <h2 id="error_field" class="pull-right"><small class="error-field">{$error}</small></h2>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">
                <form id="addCategory-form" enctype="multipart/form-data" action="controllers/category_service.php" method="POST">
                    <div class="row">
                        <!-- Background -->
                        <div class="col-md-5">
                            <div class="panel-body">
                                <div class="x_title">
                                    <h4>Background</h4>
                                </div>
                                <button id="background_category" class="btn btn-sm btn-default" type="button" ><i class="fa fa-picture-o"></i>&nbsp Select</button>
                                <input id="set_category_bg" class="set-category-bg" maxlength="128" value="" required="Mandatory field"> </input>
                                <input id="bg_file" name="bg_file" type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="display: none;"/>
                                <img id="bg_fake" src="" style="display:none;">
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <div class="row">
                        <!-- Name -->
                        <div class="col-md-6">
                            <div class="panel-body">
                                <div class="x_title">
                                    <h4>Name</h4>
                                </div>
                                <input id="set_category_name" class="set-article-title" name="setCategoryName" maxlength="128" required="Mandatory field"></input>
                            </div>
                        </div>
                        <!-- Description -->
                        <div class="col-md-6">
                            <div class="panel-body">
                                <div class="x_title">
                                    <h4>Description</h4>
                                </div>
                                <textarea id="set_category_description" name="setCategoryDescription" class="set-article-subtitle" rows="4" maxlength="500" required="Mandatory field"> </textarea>
                            </div>
                        </div>

                        <!-- Add button -->
                        <div class="row">
                            <div class="col-md-12">
                                <hr class="blog-footer-line">
                                <div class="panel-body">
                                    <button id="add-new-cateogry" name="addNewCategory" class="btn btn-sm btn-success pull-right" type="submit" onClick="add_newCategory(event)"><i class="fa fa-plus"></i> Add New</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="x_panel">
            <div class="x_title">
                <h2>Manage<small>List of categories</small> </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {foreach $categories as $category}
                    <div class="box-category">
                        <span>{$category.name}</span>
                        <div class="pull-right">
                            <button id="delete_category" class="btn btn-sm btn-default" type="submit" onClick="delete_category(event)"><i class="fa fa-trash"></i> Delete</button>
                        </div>
                    </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>
