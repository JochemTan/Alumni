<?php  

namespace App;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthenticatesUser
{
	use ValidatesRequests;

	protected $request;
	public function __construct(Request $request)
	{
		$this->request = $request;
	}
	public function invite()
	{
		$this->validatesRequest()
			->checkToken()
			->send();
	}

	protected function validatesRequest()
	{
		// check if the email thats filled in meets certain requirements.
		$this->validate($this->request,[
			'email' => 'required|email|exists:alumnus'
		]);
		return $this;
	}
	protected function checkToken()
	{
		$alumnus = Alumnus::byEmail($this->request->email);

		return LoginToken::generateFor($alumnus);
	}

	public function login(LoginToken $token)
	{

		// Auth::login($token->alumnus);
		Auth::guard('alumnus')->login($token->alumnus);
		return redirect('/alumnus');
		$token->delete();
	}
}