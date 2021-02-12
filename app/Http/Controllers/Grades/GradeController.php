<?php



namespace App\Http\Controllers\Grades;
use  App\Http\Controllers\Controller;
use  App\Http\Requests\GradeStore;

use  App\Models\Grade;
use Exception;
use Illuminate\Http\Request;

class GradeController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Grades=Grade::all();
    return view('pages.Grades.Grades',compact('Grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(GradeStore $request)

  {

   if(Grade::where('Name->ar',$request->Name)->orWhere('Name->en',$request->Name_en)->exists()){

return redirect()->back()->withErrors(trans('Grades_trans.exists'));

   }

        try {

        $validated = $request->validated();
        $Grade =new Grade();
          $Grade->Name = ['en' => $request->Name_en, 'ar' => $request->Name];
          $Grade->Notes = $request->Notes;
          $Grade->save();
           toastr()->success(trans('massege.success'));

            return redirect()->route('Grades.index');
        } catch (Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage]);
        }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {

  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(GradeStore $request)
  {

    try{
        $validated = $request->validated();
        $Grades=Grade::findOrFail($request->id);
        $Grades->update([
        $Grades->Name = ['en' => $request->Name_en, 'ar' => $request->Name],
        $Grades->Notes = $request->Notes
        ]);


        toastr()->success(trans('massege.Update'));

        return redirect()->route('Grades.index');
    }catch(Exception $ex){
        return redirect()->back()->withErrors(['error'=>$ex->getMessage]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      Grade::findOrFail($id)->delete();
      toastr()->error(trans('massege.Delete'));
      return  redirect()->route('Grades.index');

  }

}

?>
