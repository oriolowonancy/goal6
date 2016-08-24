<?php
use App\models\User;
class JokesController extends BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jokes=Joke::all();
        return Response::json([
            'data'=>$this->transformCollection($jokes)
        ], 200);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$joke = Joke::with(
            array('User'=>function($query){
                $query->select('id', 'name');
            })
            )->find($id);
        
        if(!$joke){
            return Response::json([
                'error' => [
                    'message' => 'Joke does not exist'
                ]
            ], 404);
        }
        
        //get previous joke id
        $previous = Joke::where('id', <, $joke->id)->max('id');
       
        //get next joke id
        $next = Joke::where('id', >, $joke->id)->min('id');
        
        return Response::json([
            'previous_joke_id'=>$previous,
            'next_joke_id'=>next,
            'data' => $this->transform($joke)
        ], 200);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
 
    private function transformCollection($jokes)
	{
		return array_map([$this, 'transform'], $jokes->toArray());
	}

    private function transform($jokes)
	{
		return [
           'joke_id' => $joke['id'],
            'joke' => $joke['body'],
            'submitted_by' => $joke['user']['name']
            ];
	}


}
