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
			    <td>{{ $countsAYPS['ayp05M'] }}</td>
			    <td>{{ $countsAYPS['ayp05F'] }}</td>
			    <td>{{ $countsAYPS['ayp612M'] }}</td>
			    <td>{{ $countsAYPS['ayp612F'] }}</td>
			    <td>{{ $countsAYPS['ayp1317M'] }}</td>
			    <td>{{ $countsAYPS['ayp1317F'] }}</td>
			    <td>{{ $countsAYPS['ayp1829M'] }}</td>
			    <td>{{ $countsAYPS['ayp1829F'] }}</td>
			    <td>{{ $countsAYPS['ayp3039M'] }}</td>
			    <td>{{ $countsAYPS['ayp3039F'] }}</td>
			    <td>{{ $countsAYPS['ayp4049M'] }}</td>
			    <td>{{ $countsAYPS['ayp4049F'] }}</td>
			    <td>{{ $countsAYPS['ayp5059M'] }}</td>
			    <td>{{ $countsAYPS['ayp5059F'] }}</td>
			    <td>{{ $countsAYPS['ayp6069M'] }}</td>
			    <td>{{ $countsAYPS['ayp6069F'] }}</td>
			    <td>{{ $countsAYPS['ayp7079M'] }}</td>
			    <td>{{ $countsAYPS['ayp7079F'] }}</td>
			    <td>{{ $countsAYPS['ayp80150M'] }}</td>
			    <td>{{ $countsAYPS['ayp80150F'] }}</td>
			    <td>{{ $countsAYPS['ayp0150M'] }}</td>
			    <td>{{ $countsAYPS['ayp0150F'] }}</td>
			    <td>{{$countsAYPS['ayp0150F'] + $countsAYPS['ayp0150M'] }}</td>
			</tr>
				<tr>
			    <td>AYP - Mentorship</td>
			    <td>{{ $countsAYPM['aypm05M'] }}</td>
			    <td>{{ $countsAYPM['aypm05F'] }}</td>
			    <td>{{ $countsAYPM['aypm612M'] }}</td>
			    <td>{{ $countsAYPM['aypm612F'] }}</td>
			    <td>{{ $countsAYPM['aypm1317M'] }}</td>
			    <td>{{ $countsAYPM['aypm1317F'] }}</td>
			    <td>{{ $countsAYPM['aypm1829M'] }}</td>
			    <td>{{ $countsAYPM['aypm1829F'] }}</td>
			    <td>{{ $countsAYPM['aypm3039M'] }}</td>
			    <td>{{ $countsAYPM['aypm3039F'] }}</td>
			    <td>{{ $countsAYPM['aypm4049M'] }}</td>
			    <td>{{ $countsAYPM['aypm4049F'] }}</td>
			    <td>{{ $countsAYPM['aypm5059M'] }}</td>
			    <td>{{ $countsAYPM['aypm5059F'] }}</td>
			    <td>{{ $countsAYPM['aypm6069M'] }}</td>
			    <td>{{ $countsAYPM['aypm6069F'] }}</td>
			    <td>{{ $countsAYPM['aypm7079M'] }}</td>
			    <td>{{ $countsAYPM['aypm7079F'] }}</td>
			    <td>{{ $countsAYPM['aypm80150M'] }}</td>
			    <td>{{ $countsAYPM['aypm80150F'] }}</td>
			    <td>{{ $countsAYPM['aypm0150M'] }}</td>
			    <td>{{ $countsAYPM['aypm0150F'] }}</td>
			    <td>{{$countsAYPM['aypm0150F'] + $countsAYPM['aypm0150M'] }}</td>
			</tr>
			</tr>
				<tr>
			    <td>AYP -MHMC</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc05M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc05F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc612M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc612F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc1317M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc1317F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc1829M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc1829F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc3039M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc3039F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc4049M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc4049F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc5059M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc5059F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc6069M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc6069F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc7079M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc7079F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc80150M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc80150F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc0150M'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc0150F'] }}</td>
			    <td>{{ $countsAYPSMHMC['aypmhmc0150F'] + $countsAYPSMHMC['aypmhmc0150M'] }}</td>
			</tr>
			</tr>
				<tr>
			    <td>AYP - HCBF</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf05M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf05F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf612M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf612F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf1317M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf1317F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf1829M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf1829F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf3039M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf3039F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf4049M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf4049F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf5059M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf5059F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf6069M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf6069F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf7079M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf7079F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf80150M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf80150F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf0150M'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf0150F'] }}</td>
			    <td>{{ $countsAYPSHCBF['ayphcbf0150F'] + $countsAYPSHCBF['ayphcbf0150M'] }}</td>
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
			    <td>{{ $countsTCS['tcs05M'] }}</td>
			    <td>{{ $countsTCS['tcs05F'] }}</td>
			    <td>{{ $countsTCS['tcs612M'] }}</td>
			    <td>{{ $countsTCS['tcs612F'] }}</td>
			    <td>{{ $countsTCS['tcs1317M'] }}</td>
			    <td>{{ $countsTCS['tcs1317F'] }}</td>
			    <td>{{ $countsTCS['tcs1829M'] }}</td>
			    <td>{{ $countsTCS['tcs1829F'] }}</td>
			    <td>{{ $countsTCS['tcs3039M'] }}</td>
			    <td>{{ $countsTCS['tcs3039F'] }}</td>
			    <td>{{ $countsTCS['tcs4049M'] }}</td>
			    <td>{{ $countsTCS['tcs4049F'] }}</td>
			    <td>{{ $countsTCS['tcs5059M'] }}</td>
			    <td>{{ $countsTCS['tcs5059F'] }}</td>
			    <td>{{ $countsTCS['tcs6069M'] }}</td>
			    <td>{{ $countsTCS['tcs6069F'] }}</td>
			    <td>{{ $countsTCS['tcs7079M'] }}</td>
			    <td>{{ $countsTCS['tcs7079F'] }}</td>
			    <td>{{ $countsTCS['tcs80150M'] }}</td>
			    <td>{{ $countsTCS['tcs80150F'] }}</td>
			    <td>{{ $countsTCS['tcs0150M'] }}</td>
			    <td>{{ $countsTCS['tcs0150F'] }}</td>
			    <td>{{ $countsTCS['tcs0150F'] + $countsTCS['tcs0150M'] }}</td>
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
			    <td>{{ $countsPMTCT['pmtct0150M'] }}</td>
			    <td>{{ $countsPMTCT['pmtct0150F'] }}</td>
			    <td>{{ $countsPMTCT['pmtct0150F'] + $countsPMTCT['pmtct0150M'] }}</td>
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

