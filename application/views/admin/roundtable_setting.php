<div class="main-content" >
    <div class="wrap-content container" id="container">
        <!-- start: PAGE TITLE -->
        <section id="page-title">
            <div class="row">
                <div class="col-sm-8">
                    <h1 class="mainTitle">Roundtable Setting</h1>
                </div>
            </div>
        </section>
        <div class="container-fluid container-fullw bg-white">
            <div class="row">
                 <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-light-primary" id="panel5">
                        <div class="panel-heading">
                            <h4 class="panel-title text-white">Roundtable Setting</h4>
                        </div>
                        <div class="panel-body bg-white" style="border: 1px solid #b2b7bb !important;">
                            <form id="stripekeyForm" name="stripekeyForm" action="<?= site_url() ?>admin/roundtable_setting/update_roundtable_setting"  method="post" >
                                <div class="form-group">
                                    <label>Maximum number of attendees per roundtable session</label>
                                    <input  name="roundtable_setting" id="roundtable_setting" value="<?= isset($roundtable_setting->roundtable) ? $roundtable_setting->roundtable : '' ?>" type="text" class="form-control"  placeholder="Value" required="" autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label>Max Roundtable session per attendee</label>
                                    <input  name="per_attendee" id="per_attendee" value="<?= isset($roundtable_setting->per_attendee) ? $roundtable_setting->per_attendee : '' ?>" type="text" class="form-control"  placeholder="Value" required="" autocomplete="off">
                                </div>
                                <div class="form-group" style="text-align:center;">
                                   <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- end: FEATURED BOX LINKS -->
