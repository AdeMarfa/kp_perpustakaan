<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pengembalian extends CI_Model {

	var $tabel = 'tbl_pengembalian';
	var $primary = 'id_pengembalian';
	var $order_by = 'id_pengembalian';

	public function get_all()
	{
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id_user');

				$this->db->join('tbl_peminjaman',"tbl_peminjaman.id_peminjaman=$this->tabel.id_peminjaman");
				$this->db->join('tbl_buku',"tbl_buku.id_buku=tbl_peminjaman.id_buku");
				$this->db->join('tbl_anggota',"tbl_anggota.id_anggota=tbl_peminjaman.id_anggota");
				if ($level!='admin') {
					$this->db->where("$this->tabel.id_petugas",$id_user);
				}
				$this->db->order_by($this->order_by,'DESC');
		$data = $this->db->get($this->tabel);
		return $data;
	}
	public function get_id($id)
	{
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id_user');

				$this->db->join('tbl_peminjaman',"tbl_peminjaman.id_peminjaman=$this->tabel.id_peminjaman");
				$this->db->join('tbl_buku',"tbl_buku.id_buku=tbl_peminjaman.id_buku");
				$this->db->join('tbl_anggota',"tbl_anggota.id_anggota=tbl_peminjaman.id_anggota");
				if ($level!='admin') {
					$this->db->where("$this->tabel.id_petugas",$id_user);
				}
		$data = $this->db->get_where($this->tabel, array($this->primary=>$id));
		return $data;
	}
	public function simpan($data)
	{
		return $this->db->insert($this->tabel, $data);
	}

	public function update($data,$id)
	{
		return $this->db->update($this->tabel, $data, array($this->primary=>$id));
	}

	public function hapus($id)
	{
		return $this->db->delete($this->tabel, array($this->primary=>$id));
	}
	public function sel_anggota($id='')
	{
		
				  $this->db->join('tbl_peminjaman','tbl_peminjaman.id_anggota=tbl_anggota.id_anggota');
				  $this->db->order_by('tbl_anggota.id_anggota','desc');	  
		$v_data = $this->db->get('tbl_anggota');
		?>
			<option value="">- Pilih Anggota -</option>
			<?php 
			foreach ($v_data->result() as $key => $value): 
				$v_pengembalian = $this->db->get_where($this->tabel,array('id_peminjaman'=>$value->id_peminjaman));
				if ($v_pengembalian->num_rows()==0) {?>
				<option value="<?php echo $value->id_peminjaman; ?>" <?php if($value->id_anggota==$id){echo "selected";} ?>>[<?php echo $value->nis; ?>] <?php echo ucwords($value->nama_anggota); ?></option>
			<?php 
				}
			endforeach; ?>
		<?php
		}
		public function status($id)
		{
					$this->db->join('tbl_peminjaman',"tbl_peminjaman.id_peminjaman=$this->tabel.id_peminjaman");
			$data = $this->db->get_where($this->tabel,array('id_pengembalian'=>$id))->row();
			$batas_pinjam = $data->batas_pinjam;
			$tgl_pinjam   = new DateTime($data->tgl_pinjam);
			$tgl_kembali  = new DateTime($data->tgl_kembali);
			$selisih      = $tgl_pinjam->diff($tgl_kembali);
			if ($batas_pinjam < $selisih->days) {
				echo '<label class="btn btn-danger btn-sm">Denda</label>';
			}else {
				echo '<label class="btn btn-success btn-sm">Tidak di Denda</label>';
			}
		}
}