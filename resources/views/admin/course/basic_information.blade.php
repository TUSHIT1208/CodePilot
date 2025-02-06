@extends('admin.course.create_new_course')
@section('step1')

<div class="step-content">
    <div class="step-tab-panel step-tab-info active" id="tab_step1"> 
        <div class="tab-from-content">
            <div class="title-icon">
                <h3 class="title"><i class="uil uil-info-circle"></i>Basic Information</h3>
            </div>
            <form action="{{ route('course.store')}}" method="POST">
                @csrf
                <div class="course__form">
                    <div class="general_info10">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">															
                                <div class="ui search focus mt-30 lbel25">
                                    <label>Course Title*</label>
                                    <div class="ui left icon input swdh19">
                                        <input class="prompt srch_explore" type="text" placeholder="Course title here" name="title" data-purpose="edit-course-title" maxlength="60" id="main[title]" value="">															
                                        <div class="badge_num">60</div>
                                    </div>
                                    <div class="help-block">(Please make this a maximum of 100 characters and unique.)</div>
                                </div>									
                            </div>
                            <div class="col-lg-12 col-md-12">															
                                <div class="ui search focus lbel25 mt-30">	
                                    <label>Short Description*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="description" id="" placeholder="Item description here..."></textarea>
                                        </div>
                                    </div>
                                    <div class="help-block">220 words</div>
                                </div>								
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <div class="course_des_textarea mt-30 lbel25">
                                    <label>Course Description*</label>
                                    <div class="text-editor">
                                        <textarea class="form_textarea_1 ht-4" placeholder="Item description here" style="display:none;"></textarea>
                                        <div id="editor1"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12">															
                                <div class="ui search focus lbel25 mt-30">	
                                    <label>What will students learn in your course?*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="description" id="" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="help-block">Student will gain this skills, knowledge after completing this course. (One per line).</div>
                                </div>								
                            </div>
                            <div class="col-lg-6 col-md-12">															
                                <div class="ui search focus lbel25 mt-30">	
                                    <label>Requirements*</label>
                                    <div class="ui form swdh30">
                                        <div class="field">
                                            <textarea rows="3" name="description" id="" placeholder=""></textarea>
                                        </div>
                                    </div>
                                    <div class="help-block">What knowledge, technology, tools required by users to start this course. (One per line).</div>
                                </div>								
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="mt-30 lbel25">
                                    <label>Course Level*</label>
                                </div>
                                <select class="selectpicker" multiple data-selected-text-format="count > 3">
                                    <option value="1">Beginner</option>
                                    <option value="2">Intermediate</option>
                                    <option value="3">Expert</option>
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-12">
                                <div class="mt-30 lbel25">
                                    <label>Audio Language*</label>
                                </div>
                                <select class="selectpicker" title="Select Audio" multiple data-selected-text-format="count > 4" data-size="5">
                                    <option>English</option>															
                                    <option>Español</option>
                                    <option>Português</option>
                                    <option>日本語</option>
                                    <option>Deutsch</option>
                                    <option>Français</option>
                                    <option>Türkçe</option>
                                    <option>Italiano</option>
                                    <option>हिन्दी</option>
                                    <option>Polski</option>
                                    <option>Tamil</option>
                                    <option>मराठी</option>
                                    <option>Telugu</option>														
                                    <option>Română</option>														
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="mt-30 lbel25">
                                    <label>Close Caption*</label>
                                </div>
                                <select class="selectpicker" title="Select Caption" multiple data-selected-text-format="count > 4" data-size="5">
                                    <option>English</option>															
                                    <option>Español</option>
                                    <option>Português</option>
                                    <option>Italiano</option>
                                    <option>Français</option>
                                    <option>Polski</option>
                                    <option>Deutsch</option>
                                    <option>Bahasa Indonesia</option>
                                    <option>ภาษาไทย</option>
                                    <option>हिन्दी</option>
                                    <option>Tamil</option>
                                    <option>मराठी</option>
                                    <option>Telugu</option>														
                                </select>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="mt-30 lbel25">
                                    <label>Course Category*</label>
                                </div>
                                <select class="selectpicker" title="Select Category" name="selectcategory" id="selectcategory" data-live-search="true">
                                    <optgroup label="Development">
                                        <option value="1">Web Development</option>
                                        <option value="2">Data Science</option>
                                        <option value="3">Programming Languages</option>
                                        <option value="4">Mobile Apps</option>
                                        <option value="5">Game Development</option>
                                        <option value="6">Databases</option>
                                        <option value="7">Software Testing</option>
                                        <option value="8">Software Engineering</option>
                                        <option value="9">Development Tools</option>
                                        <option value="10">E-Commerce</option>
                                    </optgroup>
                                    <optgroup label="Business">
                                        <option value="11">Finance</option>
                                        <option value="12">Entrepreneurship</option>
                                        <option value="13">Communications</option>
                                        <option value="14">Management</option>
                                        <option value="15">Sales</option>
                                        <option value="16">Strategy</option>
                                        <option value="17">Operations</option>
                                        <option value="18">Project Management</option>
                                        <option value="19">Business Law</option>
                                        <option value="20">Data &amp; Analytics</option>
                                        <option value="21">Home Business</option>
                                        <option value="22">Human Resources</option>
                                        <option value="23">Industry</option>
                                        <option value="24">Media</option>
                                        <option value="25">Real Estate</option>
                                        <option value="26">Other</option>
                                    </optgroup>
                                    <optgroup label="Finance &amp; Accounting">
                                        <option value="27">Accounting &amp; Bookkeeping</option>
                                        <option value="28">Compliance</option>
                                        <option value="29">Cryptocurrency &amp; Blockchain</option>
                                        <option value="30">Economics</option>
                                        <option value="31">Finance</option>
                                        <option value="32">Finance Cert &amp; Exam Prep</option>
                                        <option value="33">Financial Modeling &amp; Analysis</option>
                                        <option value="34">Investing &amp; Trading</option>
                                        <option value="35">Money Management Tools</option>
                                        <option value="36">Taxes</option>
                                        <option value="37">Other Finance &amp; Economics</option>
                                    </optgroup>
                                    <optgroup label="IT &amp; Software">
                                        <option value="38">IT Certification</option>
                                        <option value="39">Network &amp; Security</option>
                                        <option value="40"> Hardware</option>
                                        <option value="41">Operating Systems</option>
                                        <option value="42">Other</option>
                                    </optgroup>
                                    <optgroup label="Office Productivity">
                                        <option value="43">Microsoft</option>
                                        <option value="44">Apple</option>
                                        <option value="45">Google</option>
                                        <option value="46">SAP</option>
                                        <option value="47">Oracle</option>
                                    </optgroup>
                                    <optgroup label="Personal Development">
                                        <option value="48">Personal Transformation</option>
                                        <option value="49">Productivity</option>
                                        <option value="50">Leadership</option>
                                        <option value="51">Personal Finance</option>
                                        <option value="52">Career Development</option>
                                        <option value="53">Parenting &amp; Relationships</option>
                                        <option value="54">Happiness</option>
                                        <option value="55">Religion &amp; Spirituality</option>
                                        <option value="56">Personal Brand Building</option>
                                        <option value="57">Creativity</option>
                                        <option value="58">Influence</option>
                                        <option value="59">Self Esteem</option>
                                        <option value="60">Stress Management</option>
                                        <option value="61">Memory &amp; Study Skills</option>
                                        <option value="62">Motivation</option>
                                        <option value="63">Other</option>
                                    </optgroup>
                                    <optgroup label="Design">
                                        <option value="64">Web Design</option>
                                        <option value="65">Graphic Design</option>
                                        <option value="66">Design Tools</option>
                                        <option value="67">User Experience</option>
                                        <option value="68">Game Design</option>
                                        <option value="69">Design Thinking</option>
                                        <option value="70">3D &amp; Animation</option>
                                        <option value="71">Fashion</option>
                                        <option value="72">Architectural Design</option>
                                        <option value="73">Interior Design</option>
                                    </optgroup>
                                    <optgroup label="Marketing">
                                        <option value="74">Digital Marketing</option>
                                        <option value="75">Search Engine Optimization</option>
                                        <option value="76">Social Media Marketing</option>
                                        <option value="77">Branding</option>
                                        <option value="78">Marketing Fundamentals</option>
                                        <option value="79">Analytics &amp; Automation</option>
                                        <option value="80">Public Relations</option>
                                        <option value="81">Advertising</option>
                                        <option value="82">Video &amp; Mobile Marketing</option>
                                        <option value="83">Content Marketing</option>
                                        <option value="84">Growth Hacking</option>
                                        <option value="85">Affiliate Marketing</option>
                                        <option value="86">Product Marketing</option>
                                    </optgroup>
                                    <optgroup label="Lifestyle">
                                        <option value="87">Arts &amp; Crafts</option>
                                        <option value="88">Food &amp; Beverage</option>
                                        <option value="89">Beauty &amp; Makeup</option>
                                        <option value="90">Travel</option>
                                        <option value="91">Gaming</option>
                                        <option value="92">Home Improvement</option>
                                        <option value="93">Pet Care &amp; Training</option>
                                    </optgroup>
                                    <optgroup label="Photography">
                                        <option value="94">Digital Photography</option>
                                        <option value="95">Photography Fundamentals</option>
                                        <option value="96">Portraits</option>
                                        <option value="97">Photography Tools</option>
                                        <option value="98">Commercial Photography</option>
                                        <option value="100">Video Design</option>
                                    </optgroup>
                                    <optgroup label="Health &amp; Fitness">
                                        <option value="101">Fitness</option>
                                        <option value="102">General Health</option>
                                        <option value="103">Sports</option>
                                        <option value="104">Nutrition</option>
                                        <option value="105">Yoga</option>
                                        <option value="106">Mental Health</option>
                                        <option value="107">Dieting</option>
                                        <option value="108">Self Defense</option>
                                        <option value="109">Safety &amp; First Aid</option>
                                        <option value="110">Dance</option>
                                        <option value="111">Meditation</option>
                                    </optgroup>
                                    <optgroup label="Music">
                                        <option value="112">Instruments</option>
                                        <option value="113">Production</option>
                                        <option value="114">Music Fundamentals</option>
                                        <option value="115">Vocal</option>
                                        <option value="116">Music Techniques</option>
                                        <option value="117">Music Software</option>
                                    </optgroup>
                                </select>																
                            </div>															
                        </div>
                    </div>
                </div>  
                <div class="">
                    <button type="submit">next</button>         
                </div>  
                
                
            </form>
            
        </div>
    </div>	
    								
@endsection