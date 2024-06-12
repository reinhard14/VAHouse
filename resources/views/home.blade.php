@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Welcome to VA House Corporation') }}</div>

                <div class="card-body">
                    @include('includes.messages')

                    <h4 class="text-center mt-3">
                        Separate the list by using a comma <span class="text-danger">","</span>.
                        {{-- or period <span class="text-danger">"."</span> --}}
                    </h4>
                    <div class="row mb-5">
                        <div class="d-flex justify-content-center">
                            <small>
                                Note: Field with "<span class="text-danger">*</span>" is a required field.
                            </small>
                        </div>
                    </div>

                    <form method="post" action="{{ route('user.store') }}" id="scoresForm">
                        @csrf

                        <div class="form-group">
                            <label for="websites"><span class="text-danger">*</span> List all the <span class="text-primary">websites</span> used:</label>
                            <select id="websites" name="websites[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="tools"><span class="text-danger">*</span> List all the <span class="text-primary">tools/applications</span> used:</label>
                            <select id="tools" name="tools[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="Microsoft Office Suite">Microsoft Office Suite</option>
                                <option value="Google Workspace">Google Workspace</option>
                                <option value="Google Docs">Google Docs</option>
                                <option value="Google Sheets">Google Sheets</option>
                                <option value="Google Slides">Google Slides</option>
                                <option value="Google Drive">Google Drive</option>
                                <option value="Gmail">Gmail</option>
                                <option value="Google Calendar">Google Calendar</option>
                                <option value="Outlook">Outlook</option>
                                <option value="Word ">Word</option>
                                <option value="Excel">Excel</option>
                                <option value="PowerPoint">PowerPoint</option>
                                <option value="Illustrator">Illustrator</option>
                                <option value="InDesign">InDesign</option>
                                <option value="Trello">Trello</option>
                                <option value="Asana">Asana</option>
                                <option value="Monday.com">Monday.com</option>
                                <option value="Slack">Slack</option>
                                <option value="Zoom">Zoom</option>
                                <option value="Microsoft Teams">Microsoft Teams</option>
                                <option value="Hootsuite">Hootsuite</option>
                                <option value="Buffer">Buffer</option>
                                <option value="Sprout Social">Sprout Social</option>
                                <option value="Ring Central">Ring Central</option>
                                <option value="QuickBooks">QuickBooks</option>
                                <option value="Xero">Xero</option>
                                <option value="FreshBooks">FreshBooks</option>
                                <option value="Microsoft Excel">Microsoft Excel</option>
                                <option value="Toggl">Toggl</option>
                                <option value="Harvest">Harvest</option>
                                <option value="Dropbox">Dropbox</option>
                                <option value="Todoist">Todoist</option>
                                <option value="Wunderlist">Wunderlist</option>
                                <option value="Microsoft Office 365">Microsoft Office 365</option>
                                <option value="Wave Accounting">Wave Accounting</option>
                                <option value="Salesforce">Salesforce</option>
                                <option value="HubSpot">HubSpot</option>
                                <option value="Zendesk">Zendesk</option>
                                <option value="Freshdesk">Freshdesk</option>
                                <option value="Intercom">Intercom</option>
                                <option value="LiveChat">LiveChat</option>
                                <option value="TeamViewer">TeamViewer</option>
                                <option value="AnyDesk">AnyDesk</option>
                                <option value="Confluence">Confluence</option>
                                <option value="Helpjuice">Helpjuice</option>
                                <option value="Zoho">Zoho</option>
                                <option value="RescueTime">RescueTime</option>
                                <option value="Adobe Spark">Adobe Spark</option>
                                <option value="Facebook Insights">Facebook Insights</option>
                                <option value="Twitter Analytics">Twitter Analytics</option>
                                <option value="MailChimp">MailChimp</option>
                                <option value="Skype">Skype</option>
                                <option value="Canva">Canva</option>
                                <option value="Adobe Photoshop">Adobe Photoshop</option>
                                <option value="Shopify">Shopify</option>
                                <option value="WooCommerce">WooCommerce</option>
                                <option value="Magento">Magento</option>
                                <option value="Google Suite">Google Suite</option>
                                <option value="Google Scholar">Google Scholar</option>
                                <option value="PubMed">PubMed</option>
                                <option value="Evernote">Evernote </option>
                                <option value="Basecamp">Basecamp </option>
                                <option value="QuickBooks">QuickBooks </option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Adobe Acrobat Reader">Adobe Acrobat Reader</option>
                                <option value="OneNote">OneNote</option>
                                <option value="LastPass">LastPass</option>
                                <option value="Dashlane">Dashlane</option>
                                <option value="LinkedIn Sales Navigator">LinkedIn Sales Navigator</option>
                                <option value="DocuSign">DocuSign</option>
                                <option value="Expedia">Expedia</option>
                                <option value="Airbnb">Airbnb</option>
                                <option value="Expensify">Expensify</option>
                                <option value="Facebook Ads Manager">Facebook Ads Manager</option>
                                <option value="LinkedIn Ads">LinkedIn Ads</option>
                                <option value="iMovie">iMovie</option>
                                <option value="Adobe Premiere Pro">Adobe Premiere Pro</option>
                                <option value="BambooHR">BambooHR</option>
                                <option value="Workday">Workday</option>

                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="skills"><span class="text-danger">*</span> List all the <span class="text-primary">skills</span> you have: </label>
                            <select id="skills" name="skills[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="softskills"> List all the <span class="text-primary">soft skills</span> you possess:</label>
                            <select id="softskills" name="softskills[]" class="select2" multiple="multiple" style="width: 100%;">
                                <option value="none">None</option>
                            </select>
                            <small class="d-flex justify-content-end">
                                Select "<span class="text-danger">None</span>" if nothing is applicable.
                            </small>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rate"><span class="text-danger">*</span> Happy rate: </label>
                                    <input name="rate" type="text" class="form-control" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="portfolio"><span class="text-danger">*</span> Portfolio: </label>
                                    <input name="portfolio" type="text" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="videolink"><span class="text-danger">*</span> Video introduction link here: </label>
                                    <input name="videolink" type="text" class="form-control" required>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="experience"><span class="text-danger">*</span> Years of experience: </label>
                                    <input name="experience" type="number" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-5">
                                    <label for="resume"><span class="text-danger">*</span> Attach resume here: </label>
                                    <input name="resume" type="button" onclick="alert('Insert attachment!')" value="attachment" class="btn btn-info btn-sm form-control">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary mr-2"><i class="bi bi-file-arrow-down me-1"></i>Submit</button>
                            <a href="#" id="resetFieldButton" class="btn btn-outline-danger mr-2"><i class="bi bi-arrow-counterclockwise me-1"></i>Reset Field</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-end/index.js') }}"></script>

@endsection
