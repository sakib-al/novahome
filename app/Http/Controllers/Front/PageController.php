<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BankCurrencyRate;
use App\Models\Blog;
use App\Models\Branch;
use App\Models\Category;
use App\Models\DonationForm;
use App\Models\Event;
use App\Models\Fundraiser;
use App\Models\Gallery;
use App\Models\HomeSection;
use App\Models\OurTeam;
use App\Models\Slider;
use App\Models\Page;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Models\BranchCurrencyRate;
use App\Models\Currency;
use App\Models\MemberType;
use Illuminate\Support\Carbon;

class PageController extends Controller
{
    // Homepage
    public function homepage()
    {
        $sliders = Slider::active()->get();
        $home_sections = HomeSection::where(['status'=>1])->orderBy('position','ASC')->get();
        $fund_raisers= Fundraiser::where(['status'=>1])->OrderBy('id','DESC')->get();
        $news= Blog::where(['status'=>1])->OrderBy('created_at','DESC')->get();
        $events = Event::OrderBy('date','ASC')->where(['status'=>1])->where('date','>=',Carbon::today())->get();
        $executive_members = OurTeam::where(['status'=>1,'member_type'=>1])->orderBy('position',"ASC")->get();
        $general_members = OurTeam::where(['status'=>1,'member_type'=>2])->orderBy('position',"ASC")->get();
        $votes = Vote::where(['status'=>1])->orderBy('position',"ASC")->get();
        $gallery_categories = Category::where('for', 'gallery')->active(3)->get();
        return view('front.homepage',compact('sliders','home_sections','fund_raisers','news','events',
            'executive_members','general_members','votes','gallery_categories'));
    }

    public function contactUs(){
        return view('front.contactUs');
    }

    /*
     * method for single home section page
     * */
    public function singleHomeSection(HomeSection $homeSection)
    {
        return view('front.singleHomeSection',compact('homeSection'));
    }

    public function commonPage($slug){
        $page = Page::where('slug',$slug)->first();
        return view('front.page',compact('page'));
    }

    /*
     * method for fund raiser all program
     * */
    public function donateAll(){
        $fund_raisers=Fundraiser::where(['status'=>1])->orderBy('position','ASC')->get();
        return view('front.donation.donationProgram',compact('fund_raisers'));
    }
    /*
     * method for fund raiser single page
     * */
    public function donateNow(Fundraiser $fundRaiser){
        return view('front.donation.donation',compact('fundRaiser'));
    }

    /*
     * method for donation menu
     * */
    public function donateMenu(){
        $donation_form = DonationForm::first();
        return view('front.donation.donationNow',compact('donation_form'));
    }

    /*
     * method for single event
     * */
    public function event(Event $event){
        return view('front.event.event',compact('event'));
    }

    /*
     * method for all event
     * */
    public function eventAll()
    {
        $events = Event::OrderBy('date','ASC')->where(['status'=>1])->whereDate('date', '>', Carbon::now())->get();
        $featured_events = Event::where(['featured' => 1])->latest('id')->take(4)->get();
        $past_events = Event::where(['status'=>1])->whereDate('date', '<=', Carbon::now())->OrderBy('date','ASC')->take(4)->get();

        return view('front.event.allEvent', compact('events', 'featured_events', 'past_events'));
    }

    public function eventFeature(){
        $featured_events = Event::where(['featured' => 1])->latest('id')->paginate(16);

        return view('front.event.eventFeature', compact('featured_events'));
    }
    public function eventUpcoming(){
        $events = Event::OrderBy('date','ASC')->where(['status'=>1])->whereDate('date', '>', Carbon::now())->paginate(16);

        return view('front.event.eventUpcoming', compact('events'));
    }

    public function eventPast(){
        $events = Event::where(['status'=>1])->whereDate('date', '<=', Carbon::now())->OrderBy('date','ASC')->paginate(16);

        return view('front.event.eventPast', compact('events'));
    }

    public function allNews(){
        $news=Blog::where(['status'=>1])->orderBy('position','ASC')->get();
        return view('front.news.allNews',compact('news'));
    }

    public function singleNews(Blog $blog)
    {
        return view('front.news.singleNews',compact('blog'));
    }

    public function allVotes(){
        $votes=Vote::where(['status'=>1])->orderBy('position','ASC')->get();
        return view('front.voteAll',compact('votes'));
    }

    public function galleries(){
         $galleries = Gallery::active()->get();
         return view('front.gallery.galleries', compact('galleries'));
    }
    public function gallery(Gallery $gallery){
        return view('front.gallery.gallery', compact('gallery'));
    }

    public function memberList()
    {
        // $members = User::where(['type'=>'member','status'=>'approved'])->get(['id','first_name','last_name','email','member_type_id']);
        // dd($members);
        $types = MemberType::with('users')->where('status', 1)->get();
        return view('front.member.memberList',compact('types'));
    }


    public function galleryDetails()
    {
        return view('front.gallery.gallery_details');
    }
}
