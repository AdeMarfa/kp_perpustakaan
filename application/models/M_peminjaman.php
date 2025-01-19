<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_peminjaman extends CI_Model {

	var $tabel = 'tbl_peminjaman';
	var $primary = 'id_peminjaman';
	var $order_by = 'id_peminjaman';

	public function get_all()
	{
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id_user');

				$this->db->join('tbl_buku',"tbl_buku.id_buku=$this->tabel.id_buku");
				$this->db->join('tbl_anggota',"tbl_anggota.id_anggota=$this->tabel.id_anggota");
				if ($level!='admin') {
					$this->db->where('id_petugas',$id_user);
				}
				$this->db->order_by($this->order_by,'DESC');
		$data = $this->db->get($this->tabel);
		return $data;
	}
	public function get_id($id)
	{
		$level = $this->session->userdata('level');
		$id_user = $this->session->userdata('id_user');

				$this->db->join('tbl_buku',"tbl_buku.id_buku=$this->tabel.id_buku");
				$this->db->join('tbl_anggota',"tbl_anggota.id_anggota=$this->tabel.id_anggota");
				if ($level!='admin') {
					$this->db->where('id_petugas',$id_user);
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
				  $this->db->order_by('id_anggota','desc');
		$v_data = $this->db->get('tbl_anggota');
		?>
		<option value="">- Pilih Anggota -</option>
		<?php foreach ($v_data->result() as $key => $value): ?>
			<option value="<?php echo $value->id_anggota; ?>" <?php if($value->id_anggota==$id){echo "selected";} ?>>[<?php echo $value->nis; ?>] <?php echo ucwords($value->nama_anggota); ?></option>
		<?php endforeach; ?>
		<?php
	}
	public function sel_buku($id='')
	{
				  $this->db->order_by('id_buku','desc');
		$v_data = $this->db->get('tbl_buku');
		?>
		<option value="">- Pilih Buku -</option>
		<?php foreach ($v_data->result() as $key => $value): ?>
			<option value="<?php echo $value->id_buku; ?>" <?php if($value->id_buku==$id){echo "selected";} ?>><?php echo ucwords($value->judul); ?></option>
		<?php endforeach; ?>buku
		<?php
	}
}
