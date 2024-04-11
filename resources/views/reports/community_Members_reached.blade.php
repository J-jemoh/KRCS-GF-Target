@extends('layouts.admin')
@section('content')
 <div class="content-header bg-info">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}" class="text-white">Home</a></li>
              <li class="breadcrumb-item active"><a href="#" class="text-white">Reports</a></li>
               <li class="breadcrumb-item active"><a href="#" class="text-white">Community Members Reached</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <br>
   <section class="content">
   	<div class="card card-header"><b>Community Members Reached Report</b></div>
    <div class="container-fluid">
      <br>
    	<table id="example2" class="table table-bordered table-striped">
            <thead>
            <tr>
            <th>Program Module</th>
		      <th>0-5(M)</th>
		      <th>0-5(F)</th>
		      <th>6-12(M)</th>
		      <th>6-12(F)</th>
		      <th>13-17(M)</th>
		      <th>13-17(F)</th>
		      <th>18-29(M)</th>
		      <th>18-29(F)</th>
		      <th>30-39(M)</th>
		      <th>30-39(F)</th>
		      <th>40-49(M)</th>
		      <th>40-49(F)</th>
		      <th>50-59(M)</th>
		      <th>50-59(F)</th>
		      <th>60-69(M)</th>
		      <th>60-69(F)</th>
		      <th>70-79(M)</th>
		      <th>70-79(F)</th>
		      <th>80+(M)</th>
		      <th>80+(F)</th>
		      <th>Total(M)</th>
		      <th>Total(F)</th>
		      <th>Grand Total</th>
        </tr>
            </thead>
            <tbody>
            	<tr>
			    <td>AYP - Outreaches</td>
			    <td>{{$ayp5m}}</td>
			    <td>{{$ayp5f}}</td>
			    <td>{{$ayp12m}}</td>
			    <td>{{$ayp12f}}</td>
			    <td>{{$ayp17m}}</td>
			    <td>{{$ayp17f}}</td>
			    <td>{{$ayp29m}}</td>
			    <td>{{$ayp29f}}</td>
			    <td>{{$ayp39m}}</td>
			    <td>{{$ayp39f}}</td>
			    <td>{{$ayp49m}}</td>
			    <td>{{$ayp49f}}</td>
			    <td>{{$ayp59m}}</td>
			    <td>{{$ayp59f}}</td>
			    <td>{{$ayp69m}}</td>
			    <td>{{$ayp69f}}</td>
			    <td>{{$ayp79m}}</td>
			    <td>{{$ayp79f}}</td>
			    <td>{{$ayp80m}}</td>
			    <td>{{$ayp80f}}</td>
			    <td>{{$ayptotalm}}</td>
			    <td>{{$ayptotalf}}</td>
			    <td>{{$ayptotalm + $ayptotalf}}</td>
			</tr>
				<tr>
			    <td>AYP - Mentorship</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>AYP -MHMC</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>AYP - HCBF</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
			@foreach($kpTypeCounts as $demo)
				<tr>
			    <td>{{$demo['kp_type']}}</td>
			    <td>{{$demo['male_count5']}}</td>
			    <td>{{$demo['female_count5']}}</td>
			    <td>{{$demo['male_count12']}}</td>
			    <td>{{$demo['female_count12']}}</td>
			    <td>{{$demo['male_count']}}</td>
			    <td>{{$demo['female_count']}}</td>
			    <td>{{$demo['male_count29']}}</td>
			    <td>{{$demo['Female_count29']}}</td>
			    <td>{{$demo['m_count39']}}</td>
			    <td>{{$demo['f_count39']}}</td>
			    <td>{{$demo['m_count49']}}</td>
			    <td>{{$demo['f_count49']}}</td>
			    <td>{{$demo['m_count59']}}</td>
			    <td>{{$demo['f_count59']}}</td>
			    <td>{{$demo['m_count69']}}</td>
			    <td>{{$demo['f_count69']}}</td>
			    <td>{{$demo['m_count79']}}</td>
			    <td>{{$demo['f_count79']}}</td>
			    <td>{{$demo['countm80']}}</td>
			    <td>{{$demo['countf80']}}</td>
			    <td>{{$demo['countmm']}}</td>
			    <td>{{$demo['countff']}}</td>
			    <td>{{$demo['countmm'] + $demo['countff']}}</td>
			</tr>
			@endforeach
			</tr>
				<tr>
			    <td>TCS</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>Cash Transfer</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>HRG Outreaches</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>Vulnerable Populations</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>PMTCT</td>
			    <td>{{ $countsPMTCT['pmtct05M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct05F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct612M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct612F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct1317M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct1317F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct1829M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct1829F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct3039M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct3039F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct4049M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct4049F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct5059M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct5059F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct6069M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct6069F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct7079M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct7079F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct80150M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct80150F'] }}</td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
			</tr>
				<tr>
			    <td>CORPs</td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			    <td></td>
			</tr>
            </tbody>
          </table>

    	
    </div>
</section>
@endsection

