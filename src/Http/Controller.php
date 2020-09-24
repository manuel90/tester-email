<?php

namespace Manuel90\TesterEmail\Http;

use Illuminate\Http\Request;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Testing\MimeType;

use Auth;

use Intervention\Image\Facades\Image;

use TCG\Voyager\Facades\Voyager;

use App\Http\Controllers\Controller as BaseController;

use Manuel90\TesterEmail\GenericEmail;

class Controller extends BaseController
{

    public function __construct() {
        if( class_exists('Voyager') ) {
            $this->middleware('admin.user')->only('index');
        }
    }

    public function index(Request $request) {
        $message = $request->get('message','');
        if( class_exists('Voyager') ) {
            return view('testeremail::indexvoyager',['message' => $message]);
        }
        return view('testeremail::index',['message' => $message]);
    }

    
    public function sendEmail(Request $request) {
        try {
            $email = $request->get('email', null);

            if(!$email || (!\filter_var($email, FILTER_VALIDATE_EMAIL)) ) {
                throw new TesterEmailException("email_not_valid");
            }

            if( class_exists('Voyager') && (!auth()->check()) ) {
                throw new TesterEmailException("login_required");
            }

            $email = trim($email);

            self::emailReport('Hello '.$email,'Manuel90\TesterEmail\Http:sendEmail line 37', 'Info Email', $email);

            return redirect()->route('testeremail.index');
        } catch(TesterEmailException $te) {
            return redirect()->route('testeremail.index', ['message' => $te->getMessage()]);
        } catch (\Exception $e) {
            return redirect()->route('testeremail.index', ['message' => 'not_sended']);
        }
    }

    public function assets(Request $request) {
        try {
            $path = $request->get('path','');
            if(!$path) {
                return response()->json(null,Response::HTTP_NOT_FOUND);
            }
            $pathToFile = __DIR__."/../../publishable/assets/$path";

            if( !file_exists($pathToFile) ) {
                return response()->json($pathToFile,Response::HTTP_NOT_FOUND);
            }
            
            $mimeType = MimeType::from(basename($pathToFile));

            return response()->file($pathToFile,array(
                'Content-Type' => $mimeType,
            ));
        } catch (\Exception $e) {
            return response()->json(null,Response::HTTP_NOT_FOUND);
        }
    }

    public static function emailReport($message, $nameMethod, $message2 = 'Info Email', $emails = '') {
        
        if( empty($emails) ) {
            return;
        }

        $report = <<<EOF

        This is a message test to check mailing system:

        $message

        it happend over:

        $nameMethod

EOF;

        return \Illuminate\Support\Facades\Mail::to( explode(',',$emails) )->send(
            (new GenericEmail($report,$message2))
                    ->subject(__('Information Email'))
        );
    }
}


class TesterEmailException extends \Exception  {

}
