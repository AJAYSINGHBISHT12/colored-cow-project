<?php

namespace Modules\HR\Database\Seeders;

use Modules\HR\Entities\Round;
use Illuminate\Database\Seeder;

class HRRoundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Round::updateOrCreate([
            'name' => 'Resume Screening'
        ], [
            'guidelines' => '<ol><li>Evaluate the basic criterion required for the job role.<ol><li>For lateral openings - relevant and great portfolio. Employment  Experience - What kind of company they worked with - How long?</li><li>For fresher - the core subjects, portfolio<ol><li>Patterns in grades<ol><li>Any special pattern in grades - like consistency, declining or increasing consistently. Gap, change in study stream, special courses.</li><li>Evidence of consistency - Through grades or any achievement.</li><li>Evidence of Bounce Back - From low grades to great ones. From anything poor to something great.</li></ol></li><li>His self-assessment (resume interview)<ol><li>Do you have your resume in front of you?</li><li>Does it represent you in the true sense?</li><li>Which part do you want to highlight?</li></ol></li><li>Internship Experience - Where? Kind of work? How they got it? How long?</li><li>If grades and proves are not good<ol><li>His take on his situation<ol><li>Is he a whiner?</li></ol></li><li>Does he look fake?</li><li>Does he realize the need to correct the situation?<ol><li>Able to thrive under the support and guidance?</li><li>how serious is he about his career?<ol><li>What are the alternatives he is having?<ol><li>Further Studies?</li></ol></li></ol></li></ol></li><li>Is he hopeful or just want to get by?<ol><li>Does he have a healthy self-image?</li></ol></li></ol></li></ol></li></ol></li><li>Evidence of Self Learning. Quick Learner. <ol><li>Has learned something more than what course asked for.</li><li>What is the depth of execution and knowledge? His self-rating. Your assessment rating.</li><li>Check too much dependency on training institutes to learn skills.</li><li>Learning methodology - Structural, ad-hoc.</li><li>Suggestive questions<ol><li>In case the candidate has proof of Self and Quick Learner<ol><li>Why he picked that skill?</li><li>What were the challenges?</li><li>How did he balance between regular and this extra?</li><li>What are the other things he wants to learn now?</li></ol></li><li>In case the candidate doesn\'t have proof<ol><li>What is the belief system about learning</li><li>The reason for his not doing it</li><li>How can he correct, if he agrees, the situation now?</li></ol></li></ol></li></ol></li><li>Evidence of a Champion - like a national swimmer, a finalist in India Idol, or something similar but at a decent level. Any sign of some exceptional result?</li><li>Evidence of Leadership - Like school captain, leadership position in college communities.</li><li>Healthy LinkedIn network - Is it big enough? Is it just people up, or down, or a good spread?</li><li>Local but long commute?</li><li>The University Ranking - Like IIT, IIM where getting admission is very competitive.</li><li>Seriousness in applying? - Detail of the answer for "Reason for eligibility"<br /><ol><li>Check the written Communication as a side effect.</li></ol></li><li>Openness and Biases</li><li>Family Background - <ol><li>How independent?</li><li>Influenced by</li><li>How they enable him to become what he is today?</li></ol></li><li>Passion check - Passionfruit question.<ol><li>Check rigidity - Vamsi pattern</li></ol></li><li>Interesting Check<ol><li>Storyteller</li><li>Energetic</li><li>Presentable</li><li>Laughing and smiling</li><li>Crack the joke or appreciate the joke</li><li>Too serious or too funny</li><li>Take things easy</li><li>Reaction on feedback, criticism.</li></ol></li><li>The gut feeling of the fitment.</li><li>Communication<ol><li>Verbal</li></ol></li><li>Along with passing your feedback in resume screening or any other round, if you have unanswered questions or need more clarification from the candidate, you should mention that in your feedback for that round. For example, you want to see the entreprenurial side of the candidate and don\'t see much in the resume, then you can mention that in your feedback in resume screening round that you like this resume but couldn\'t find one important parameter, do check in the next round.</li></ol>',
            'reminder_enabled' => 0,
            'confirmed_mail_template' => '{"body": "<div>Hey |*applicant_name*|, </div><div> </div><div>Thanks for applying for |*job_title*| </div><div><div> </div><div>Your resume looks interesting. </div><div> </div><div>Interesting enough, that we\'d like to invite you for a 30-minutes chat over video to discuss more. We\'ll send you a separate calendar invite email with details. Please note the Hangout link in that calendar invite and use that link for video chat on the discussion day. </div><div> </div><div>This will be a chance for you to learn more about ColoredCow and for us to learn more about you and your aspirations. </div><div> </div><div>Check the page below to learn more about ColoredCow. </div><div><a href=\\"https://www.facebook.com/ColoredCowConsulting/\\">https://www.facebook.com/ColoredCowConsulting/</a></div><div> </div><div>We are in an interesting phase of growth and offer a chance for hands-on learning and an opportunity to take your career in the direction of your dreams. </div><div> </div><div>In case you have questions, now or later, feel free to email us. We\'ll be happy to answer those for you. </div><div> </div><div>Looking forward to chatting soon.</div><div> </div><div><em>We suggest you join the call 5 minutes before the meeting. And if you face any problem, please don\'t hesitate to call 9818571035</em></div><div> </div><div>Thanks!</div><div>HR Team</div><div>ColoredCow</div></div>", "subject": "ColoredCow congratulates you on making it to the next round!"}',
            'rejected_mail_template' => '{"body": "<div>Hi |*applicant_name*|, </div><div> </div><div>Thanks for considering ColoredCow as your next Career choice. </div><div> </div><div>As we see you applied for |*job_title*| but somehow this job requires different skills than your current resume reflects. </div><div> </div><div>We are sure that you are a great candidate and we will be in touch and let you know about the future openings at ColoredCow. </div><div> </div><div>At ColoredCow we are in an interesting phase of growth and offer a chance for hands-on learning and an opportunity to take your career in the direction of your dreams. If not this time, we hope we will meet soon in near future. </div><div> </div><div>Meanwhile, if you want to learn about the latest happenings at ColoredCow and wish to keep in touch with us, our FB page is the best place to do so. </div><div>Here is the link just for you <a href=\\"https://www.facebook.com/ColoredCowConsulting/\\">https://www.facebook.com/ColoredCowConsulting/ </a></div><div> </div><div>Thanks again for applying. </div><div> </div><div>HR Team<br />ColoredCow</div>", "subject": "Your Job application with ColoredCow"}',
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Introductory Call',
        ], [
            'guidelines' => 'Look for the creativity',
            'reminder_enabled' => 1,
            'confirmed_mail_template' => '{"body": "<p class=\\"p1\\">Hi |*applicant_name*|,</p><p class=\\"p1\\">Thanks for talking to us on |*interview_time*|.<br /><br />It\'s nice talking to you. We are glad that candidly shared your life stories and experiences with us. It all was quite interesting!<br /><br />Interesting enough, that we\'d like to invite you for a 30-minutes chat over video. This call is going to be about the Computer Science basics. I\'ll send you a separate email with details.<br /><br />This will be a chance for you to learn more about ColoredCow and for us to learn more about you and your concepts, and knowledge. <br /><br />As we said earlier we are in an interesting phase of growth and offer a chance for hands-on learning and an opportunity to take your career in the direction of your dreams. <br /><br />In case you have questions, now or later, feel free to email me. I\'ll be happy to answer those for you.<br /><br />Looking forward to chatting soon.</p><p class=\\"p1\\">Our FB page is the best place to get most of the update about happening at ColoredCow, be it our work or opportunities to work together. Check that out to know more <a href=\\"https://www.facebook.com/ColoredCowConsulting/\\">https://www.facebook.com/ColoredCowConsulting/</a><br /><br />Thanks<br />HR Team<br />ColoredCow</p>", "subject": "ColoredCow Congratulates you again on making it to the next round!"}',
            'rejected_mail_template' => '{"body": "<div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Hi <span style=\\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px;\\">|*applicant_name*|,</span>,<span style=\\"font-size: 14.4px;\\"> </span></div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Thanks for considering ColoredCow as your next Career choice. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">We enjoyed talking to you on (date). <span style=\\"box-sizing: border-box; font-size: 14.4px;\\">We are sure that you are a great candidate but the job you applied for requires different skills than what we gathered from your resume and the interview. It was a hard decision. That is why we would like to stay in touch with you for future opportunities that might be a good fit for your profile. </span></div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">At ColoredCow we are in an interesting phase of growth and offer a chance for hands-on learning and an opportunity to take your career in the direction of your dreams. If not this time, we hope we will meet soon in near future. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Meanwhile, if you want to learn about the latest happenings at ColoredCow and wish to keep in touch with us, our FB page is the best place to do so. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Here is the link just for you <a style=\\"box-sizing: border-box; color: #007bff; text-decoration-line: none; background-color: transparent;\\" href=\\"https://www.facebook.com/ColoredCowConsulting/\\">https://www.facebook.com/ColoredCowConsulting/ </a></div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Thanks again for applying. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">HR Team<br style=\\"box-sizing: border-box;\\" />ColoredCow</div>", "subject": "Your Job application with ColoredCow"}',
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Basic Technical Round',
        ], [
            'guidelines' => '',
            'reminder_enabled' => 1,
            'confirmed_mail_template' => '{"body": "<p class=\\"p1\\">Hi |*applicant_name*|,<br /><br />Thanks for talking to us on |*interview_time*|.<br /><br />It was nice talking to you. We liked you and the way you were able to answer our questions on the fundamentals of Computer Science.<br /><br />Happy to share that you have been selected for our internship program this winter!<br /><br />The internship program will on Thursday, January 11th, 2019. You can join at one of our offices in Tehri and Gurugram. Do let us know where you\'ll prefer to join.<br /><br />We have created a consolidated list based on the queries we received from multiple students who applied for our internship program.<br /><a href=\\"https://docs.google.com/document/d/1-1WD-a00aann4bAVOlTYyU8E3Rvg7bdhUjmCQ0ckCkY/edit?usp=sharing\\">FAQs for Engineering Internship</a><br />We hope you\'ll find answers to your queries there. In case you don\'t feel free to email us with your queries. We\'ll be happy to answer them for you.<br /><br />Our FB page is the best place to get most of the update about happening at ColoredCow. Keep checking for updates here:<br /><a href=\\"https://www.facebook.com/ColoredCowConsulting/\\">https://www.facebook.com/ColoredCowConsulting/</a><br /><br />Thanks<br />HR Team<br />ColoredCow</p>", "subject": "ColoredCow - You\'ve been selected for the internship!"}',
            'rejected_mail_template' => '{"body": "<p class=\\"p1\\">Hi |*applicant_name*|,<br /><br />Thank you for applying for the internship at ColoredCow.<br /><br />We have completed the evaluation process for your application. We concluded that you need some more time building your skills before joining an internship with ColoredCow.<br /><br />ColoredCow internship focuses on giving candidates exposure to different aspects of building software. Candidates need to have some computer science and software development fundamentals to gain benefits from the program.<br /><br />We will be glad to help you out in acquiring these software development fundamentals and make you ready to be part of our next summer internship in 2019. There are some very exciting CodeTrek programs scheduled for the upcoming 6 months. Keep an eye out for them.<br />We are sure these programs will help you gather the right skills and guide you towards a great career as a Software Engineer.<br /><br />To get more updates and opportunities at ColoredCow, do follow our FB page:<br /><a href=\\"https://www.facebook.com/ColoredCowConsulting\\">https://www.facebook.com/ColoredCowConsulting</a><br /><br />Looking forward to seeing you in CodeTrek!<br />HR Team<br />ColoredCow</p>", "subject": "Your internship at ColoredCow"}',
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Detailed Technical Round',
        ], [
            'guidelines' => null,
            'reminder_enabled' => 1,
            'confirmed_mail_template' => null,
            'rejected_mail_template' => null,
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Team Interaction Round',
        ], [
            'guidelines' => null,
            'reminder_enabled' => 1,
            'confirmed_mail_template' => null,
            'rejected_mail_template' => null,
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'HR Round',
        ], [
            'guidelines' => null,
            'reminder_enabled' => 1,
            'confirmed_mail_template' => null,
            'rejected_mail_template' => '{"body": "<div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Hi <span style=\\"color: #000000; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px;\\">|*applicant_name*|,</span>,<span style=\\"font-size: 14.4px;\\"> </span></div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Thanks for considering ColoredCow as your next Career choice. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">We enjoyed talking to you on (date). <span style=\\"box-sizing: border-box; font-size: 14.4px;\\">We are sure that you are a great candidate but the job you applied for requires different skills than what we gathered from your resume and the interview. It was a hard decision. That is why we would like to stay in touch with you for future opportunities that might be a good fit for your profile. </span></div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">At ColoredCow we are in an interesting phase of growth and offer a chance for hands-on learning and an opportunity to take your career in the direction of your dreams. If not this time, we hope we will meet soon in near future. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Meanwhile, if you want to learn about the latest happenings at ColoredCow and wish to keep in touch with us, our FB page is the best place to do so. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Here is the link just for you <a style=\\"box-sizing: border-box; color: #007bff; text-decoration-line: none; background-color: transparent;\\" href=\\"https://www.facebook.com/ColoredCowConsulting/\\">https://www.facebook.com/ColoredCowConsulting/ </a></div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">Thanks again for applying. </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\"> </div><div style=\\"box-sizing: border-box; color: #212529; font-family: Raleway, sans-serif; font-size: 14.4px; white-space: pre-wrap;\\">HR Team<br style=\\"box-sizing: border-box;\\" />ColoredCow</div>", "subject": "Your Job application with ColoredCow"}',
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Trial Program',
        ], [
            'guidelines' => null,
            'reminder_enabled' => 1,
            'confirmed_mail_template' => '{"body": "Dear |*applicant_name*|, <div> </div><div>It was great talking to you regarding the |*job_title*| opportunity. Given our conversation, we would like to move on to the next round. <br /><br /></div>", "subject": null}',
            'rejected_mail_template' => null,
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Volunteer Screening',
        ], [
            'guidelines' => null,
            'reminder_enabled' => 0,
            'confirmed_mail_template' => null,
            'rejected_mail_template' => null,
            'in_trial_round' => 0,
        ]);

        Round::updateOrCreate([
            'name' => 'Trial Program',
        ], [
            'guidelines' => null,
            'reminder_enabled' => 0,
            'confirmed_mail_template' => '{"body": "Dear |*applicant_name*|, <div> </div><div>It was great talking to you regarding the |*job_title*| opportunity. Given our conversation, we would like to move on to the next round. <br /><br /></div>", "subject": null}',
            'rejected_mail_template' => null,
            'in_trial_round' => 0,
        ]);
    }
}
