@extends('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-text">
                        Welcome to VA House Corporation
                    </div>
                    <div class="card-tools">
                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#guidelinesModal">
                            READ IMPORTANT GUIDELINES! CLICK HERE!
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    @include('includes.messages')

                    <h4 class="text-center mt-3">
                        Separate the list by using a comma "<span class="text-danger">,</span>" or a "<span class="text-danger">tab</span>" bar.
                    </h4>

                    <div class="row mb-5">
                        <div class="d-flex justify-content-center">
                            <small>
                                Note: Field with "<span class="text-danger">*</span>" is a required field.
                            </small>
                        </div>
                    </div>

                    <form method="post" action="{{ route('user.store') }}" id="scoresForm" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="websites"><span class="text-danger">*</span> List all the <span class="text-primary">websites</span> used:</label>

                            <select id="websites" name="websites[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="Upwork">Upwork</option>
                                <option value="LinkedIn">LinkedIn</option>
                                <option value="Behance">Behance</option>
                                <option value="Indeed">Indeed</option>
                                <option value="Glassdoor">Glassdoor</option>
                                <option value="ZipRecruiter">ZipRecruiter</option>
                                <option value="Canva">Canva</option>
                                <option value="Udemy">Udemy</option>
                                <option value="Coursera">Coursera</option>
                                <option value="HubSpot Academy">HubSpot Academy</option>
                                <option value="YouTube">YouTube</option>
                                <option value="IRS website">IRS website</option>
                                <option value="IRS.gov">IRS.gov</option>
                                <option value="AICPA.org">AICPA.org</option>
                                <option value="QuickBooks">QuickBooks</option>
                                <option value="Xero Central">Xero Central</option>
                                <option value="Investopedia">Investopedia</option>
                                <option value="Amazon">Amazon</option>
                                <option value="eBay">eBay</option>
                                <option value="Etsy">Etsy</option>
                                <option value="Shopify">Shopify</option>
                                <option value="Craigslist">Craigslist</option>
                                <option value="Monster">Monster</option>
                                <option value="Freelancer">Freelancer</option>
                                <option value="Fiverr">Fiverr</option>
                                <option value="Google Scholar">Google Scholar</option>
                                <option value="PubMed">PubMed</option>
                                <option value="Adobe Spark">Adobe Spark</option>
                                <option value="Grammarly">Grammarly</option>
                                <option value="Hemingway Editor">Hemingway Editor</option>
                                <option value="TED Talks">TED Talks</option>
                                <option value="Social media platforms">Social media platforms</option>
                                <option value="Content creation platforms">Content creation platforms</option>
                                <option value="Freelance marketplaces">Freelance marketplaces</option>
                                <option value="Online learning platforms">Online learning platforms</option>
                                <option value="Industry blogs and forums">Industry blogs and forums</option>
                                <option value="Social Media Examiner">Social Media Examiner </option>
                                <option value="Reddit">Reddit</option>
                                <option value="News and trends websites">News and trends websites</option>
                                <option value="Social Media Today">Social Media Today</option>
                                <option value="Marketing Land">Marketing Land</option>
                                <option value="WordPress">WordPress</option>
                                <option value="Zillow">Zillow</option>
                                <option value="Realtor.com">Realtor.com</option>
                                <option value="MLS">MLS</option>
                                <option value="National Association of Realtors">National Association of Realtors</option>
                                <option value="Property management software platforms">Property management software platforms</option>
                                <option value="Buildium">Buildium</option>
                                <option value="AppFolio">AppFolio</option>
                                <option value="Real estate blogs and forums for industry news and updates">Real estate blogs and forums for industry news and updates</option>
                                <option value="Virtual assistant job platforms">Virtual assistant job platforms</option>
                                <option value="Real estate investing websites">Real estate investing websites</option>
                                <option value="BiggerPockets">BiggerPockets</option>
                                <option value="Alibaba">Alibaba</option>
                                <option value="Walmart">Walmart</option>
                                <option value="Gmail">Gmail</option>
                                <option value="SHRM (Society for Human Resource Management)">SHRM (Society for Human Resource Management)</option>
                                <option value="HR blogs and forums for industry updates and best practices">HR blogs and forums for industry updates and best practices</option>
                                <option value="Google Search">Google Search</option>
                                <option value="Online databases">Online databases</option>
                                <option value="EBSCO">EBSCO</option>
                                <option value="JSTOR">JSTOR</option>
                            </select>

                            <small class="d-flex justify-content-end">
                                (Capitalize 1st Letter Only)
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
                                (Capitalize 1st Letter Only)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="skills"><span class="text-danger">*</span> List all the <span class="text-primary">skills</span> you have: </label>

                            <select id="skills" name="skills[]" class="select2" multiple="multiple" style="width: 100%;" required>
                                <option value="Content Creation">Content Creation</option>
                                <option value="Quality Control">Quality Control</option>
                                <option value="Design">Design</option>
                                <option value="Innovation and Trends">Innovation and Trends</option>
                                <option value="Website Design and Development">Website Design and Development</option>
                                <option value="Project Management">Project Management</option>
                                <option value="Team Leadership">Team Leadership</option>
                                <option value="Project Coordination">Project Coordination</option>
                                <option value="Proficiency in accounting">Proficiency in accounting</option>
                                <option value="Financial data entry and analysis">Financial data entry and analysis</option>
                                <option value="Strong organizational skills">Strong organizational skills</option>
                                <option value="Generate financial reports and statements">Generate financial reports and statements</option>
                                <option value="Tax preparation and filing processes">Tax preparation and filing processes</option>
                                <option value="Excellent communication skills">Excellent communication skills</option>
                                <option value="Problem-solving skills">Problem-solving skills</option>
                                <option value="Time management">Time management</option>
                                <option value="Communication skills">Communication skills</option>
                                <option value="Organizational skills">Organizational skills</option>
                                <option value="Leadership skills">Leadership skills</option>
                                <option value="Attention to detail">Attention to detail</option>
                                <option value="Ability to multitask">Ability to multitask</option>
                                <option value="Decision-making skills">Decision-making skills</option>
                                <option value="Team management">Team management</option>
                                <option value="Bookkeeping">Bookkeeping</option>
                                <option value="Data entry">Data entry</option>
                                <option value="Financial analysis">Financial analysis</option>
                                <option value="Strong interpersonal abilities">Strong interpersonal abilities</option>
                                <option value="Active listening skills">Active listening skills</option>
                                <option value="Multi-tasking abilities">Multi-tasking abilities</option>
                                <option value="Empathy and patience">Empathy and patience</option>
                                <option value="Conflict resolution skills">Conflict resolution skills</option>
                                <option value="Adaptability and flexibility">Adaptability and flexibility</option>
                                <option value="Content creation and curation">Content creation and curation</option>
                                <option value="Community engagement">Community engagement</option>
                                <option value="Analytics and reporting">Analytics and reporting</option>
                                <option value="Copywriting ">Copywriting </option>
                                <option value="Graphic design">Graphic design</option>
                                <option value="Customer service">Customer service</option>
                                <option value="Accuracy">Accuracy</option>
                                <option value="Social media management skills">Social media management skills</option>
                                <option value="Basic accounting knowledge">Basic accounting knowledge</option>
                                <option value="Order Processing">Order Processing</option>
                                <option value="Inventory Management">Inventory Management</option>
                                <option value="Product Research">Product Research</option>
                                <option value="Administrative support">Administrative support</option>
                                <option value="Multitasking-Research skills">Multitasking-Research skill</option>
                                <option value="Data analysis ">Data analysis</option>
                            </select>

                            <small class="d-flex justify-content-end">
                                (Capitalize 1st Letter Only)
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="softskills"> List all the <span class="text-primary">soft skills</span> you possess:</label>

                            <select id="softskills" name="softskills[]" class="select2" multiple="multiple" style="width: 100%;">
                                <option value="none">None</option>
                            </select>

                            <small class="d-flex justify-content-end">
                                (Capitalize 1st Letter Only)
                            </small>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="skype"><span class="text-danger">*</span> Skype ID</label>

                                    <input name="skype" type="text" class="form-control" placeholder="Skype id here.." required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="niche"><span class="text-danger">*</span> Niche</label>

                                    <input name="niche" type="text" class="form-control" placeholder="Input niche here.." required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rate"><span class="text-danger">*</span> Happy rate: <strong>(In pesos)</strong> </label>

                                    <input name="rate" type="number" class="form-control" placeholder="Enter monthly rate.." required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label for="experience"><span class="text-danger">
                                                *</span> Total years of experience: </label>
                                                <strong>(Click to <a href="#create-details-modal" data-bs-toggle="modal" class="button">Expand</a>)</strong>
                                        </div>
                                    </div>

                                    <input name="experience" type="number" class="form-control" placeholder="Please 'Click to Expand' to specify your experiences.." required>
                                </div>
                            </div>
                        </div>

                        @if($user->experiences->count() < 1)
                            <div class="row m-1 p-3 border rounded border-line border-secondary" id="noExperiencePlaceholder">
                                <div class="col">
                                    <div class="text-center">
                                        <h6>No <span class="text-danger">Experiences</span> added yet.</h6>
                                        <p class="pt-3">Please click <span class="text-info">"Expand"</span> to add experiences.</p>
                                        <p class="italic-fst">This is a required field</p>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive" id="showExperiencesTable">
                            </div>
                        @else
                            <div class="row">
                                <p>Experience details:</p>
                                <div class="table-responsive">
                                    <table class="table table-hover border">
                                        <thead>
                                            <tr>
                                            <th scope="col">Job Experience</th>
                                            <th scope="col">Duration</th>
                                            </tr>
                                        </thead>
                                        <tbody id="experienceList">
                                            @foreach($user->experiences as $experience)
                                            <tr>
                                                <td>
                                                    {{ $experience->title }}
                                                </td>
                                                <td>
                                                    {{ $experience->duration }}
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ub_account"><span class="text-danger">*</span> Union Bank Account Holder Name</label>

                                    <input name="ub_account" type="text" class="form-control" placeholder="Enter your bank account name.." required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ub_number"><span class="text-danger">*</span> Union Bank Account Number</label>

                                    <input name="ub_number" type="text" class="form-control" placeholder="Enter bank account number.." required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo_id"><span class="text-danger">*</span> Two Valid IDs</label>

                                    <input name="photo_id" type="file" accept=".jpeg, .jpg, .png" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="photo_formal"><span class="text-danger">*</span> Formal Photo</label>

                                    <input name="photo_formal" type="file" accept=".jpeg, .jpg, .png" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="resume"><span class="text-danger">*</span> Attach resume/CV here: (PDF file only)</label>

                                    <input name="resume" type="file" accept="application/pdf" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="disc_results"><span class="text-danger">*</span> DISC Result: (PDF file only)</label>

                                    <input name="disc_results" type="file" accept="application/pdf" class="form-control" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="portfolio"><span class="text-danger">*</span> Portfolio:  (PDF file only)</label>

                                    <input name="portfolio" type="file" accept="application/pdf" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="videolink"><span class="text-danger">*</span> Upload video introduction: <strong>(10MB limit)</strong> </label>

                                    <input name="videolink" type="file" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-5 p-5">
                            <h4 class="text-center mb-3">
                                Position/s Applying For
                            </h4>
                            <div class="col">
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" id="position1" name="positions[]" value="General Virtual Assistant">

                                        <label for="position1"> General Virtual Assistant: </label>

                                        <p class="fst-italic">
                                            - Admin Assistant, Data Entry, Email Management, Executive Assistant, Accounting, Bookeeping
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" id="position2" name="positions[]" value="Social Media Manager">

                                        <label for="position2"> Social Media Manager: </label>

                                        <p class="fst-italic">
                                            - SEO, Digital Marketing, FB Ads, Making Brochures and Flyers
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" id="position3" name="positions[]" value="Callers">

                                        <label for="position3"> Callers: </label>

                                        <p class="fst-italic">
                                            - CSR/Technical Support
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" id="position4" name="positions[]" value="Web Developers">

                                        <label for="position4"> Web Developers:</label>

                                        <p class="fst-italic">
                                            - Content Creation, Web Hosting (Management)
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" id="position5" name="positions[]" value="Tech VAs">

                                        <label for="position5"> Tech VAs:</label>

                                        <p class="fst-italic">
                                            -  Video Editors, Content Collaborators and Creators (Creating IG Reels and Tiktok for Marketing purposes)
                                        </p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <input type="checkbox" id="position6" name="positions[]" value="Project Manager">

                                        <label for="position6"> Project Manager</label>
                                    </div>
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


<x-applicant.guidelines />
<x-applicant.details />

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="{{ asset('dist/js/pages/user-end/index.js') }}"></script>

@endsection
