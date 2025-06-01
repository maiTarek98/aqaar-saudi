
                @if(app(App\Models\SocialSettings::class)->twitter_link)
                <a href="{{app(App\Models\SocialSettings::class)->twitter_link}}" target="_blank" aria-label="رابط إلى تويتر">
                  <i class="fa-brands fa-x-twitter"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->facebook_link)
                <a href="{{app(App\Models\SocialSettings::class)->facebook_link}}" target="_blank" aria-label="رابط إلى فيسبوك">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->linkedin_link)
                <a href="{{app(App\Models\SocialSettings::class)->linkedin_link}}" target="_blank" aria-label="رابط إلى لينكد إن">
                  <i class="fa-brands fa-linkedin-in"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->snapchat_link)
                <a href="{{app(App\Models\SocialSettings::class)->snapchat_link}}" target="_blank" aria-label="رابط إلى سناب شات">
                  <i class="fa-brands fa-snapchat"></i>
                </a>
                @endif
                
                
                @if(app(App\Models\SocialSettings::class)->instagram_link)
                <a href="{{app(App\Models\SocialSettings::class)->instagram_link}}" target="_blank" aria-label="رابط إلى فيسبوك">
                  <i class="fa-brands fa-instagram"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->youtube_link)
                <a href="{{app(App\Models\SocialSettings::class)->youtube_link}}" target="_blank" aria-label="رابط إلى لينكد إن">
                  <i class="fa-brands fa-youtube"></i>
                </a>
                @endif
                @if(app(App\Models\SocialSettings::class)->tiktok_link)
                <a href="{{app(App\Models\SocialSettings::class)->tiktok_link}}" target="_blank" aria-label="رابط إلى سناب شات">
                  <i class="fa-brands fa-tiktok"></i>
                </a>
                @endif